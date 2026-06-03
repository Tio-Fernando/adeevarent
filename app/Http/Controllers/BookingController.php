<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\Pelanggan;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\CoreApi;
use SweetAlert2\Laravel\Swal;

class BookingController extends InvoiceController 
{
    public function index(Request $request){
        $search = $request->get('search');
        $tanggalDari = $request->get('tanggal_dari', Carbon::now()->toDateString());
        $tanggalSampai = $request->get('tanggal_sampai', Carbon::now()->toDateString());

        $booking = Sewa::with('payments')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('id_tr_sewa', 'like', '%' . $search . '%')
                      ->orWhere('nopol', 'like', '%' . $search . '%');

                    if (strlen($search) >= 8) {
                        $q->orWhereRaw("DATE_FORMAT(created_at, '%Y%m%d') = ?", [substr($search, 0, 8)])
                          ->where(function ($subQ) use ($search) {
                              $subQ->where('id_tr_sewa', 'like', substr($search, 8) . '%');
                          });
                    }
                })
                ->orWhereHas('pelanggan', function ($q) use ($search) {
                    $q->where('nama_pelanggan', 'like', '%' . $search . '%');
                });
            })
            ->when($tanggalDari, function ($query) use ($tanggalDari) {
                return $query->whereDate('tanggal_sewa', '>=', $tanggalDari);
            })
            ->when($tanggalSampai, function ($query) use ($tanggalSampai) {
                return $query->whereDate('tanggal_sewa', '<=', $tanggalSampai);
            })
            ->latest()
            ->paginate(10);
        
        return view('admin.booking.index', compact('booking', 'search', 'tanggalDari', 'tanggalSampai'));
    }

    public function selesai(Request $request, $id_tr_sewa){
        $sewa = Sewa::with('kendaraan')->findOrFail($id_tr_sewa);
        if ($sewa->status !== 'lunas') {
        return redirect()->back()->with('error', 'Pesanan harus dilunasi terlebih dahulu.');
    }

    $pengembalian = Carbon::now('Asia/Jakarta');
    $jadwalKembali = Carbon::parse($sewa->tanggal_kembali, 'Asia/Jakarta');
$denda = 0;

if ($pengembalian->greaterThan($jadwalKembali)) {

    $lateMinutes = $jadwalKembali->diffInMinutes($pengembalian);

   
    if ($lateMinutes > 60) {

        $lateMinutes -= 60;

        $lateHours = ceil($lateMinutes / 60);

        $dendaPerJam = (int) $sewa->kendaraan->denda_terlambat;

        $denda = $lateHours * $dendaPerJam;
    }
}
    $sewa->update([
        'status' => 'selesai',
        'tanggal_kembali' => $pengembalian,
        'denda' => $denda,
    ]);

    if ($sewa->kendaraan) {
        $sewa->kendaraan->update([
            'status' => 'free'
        ]);
    }

       Swal::success([
            'title' => 'Berhasil',
            'text' => 'Booking Telah Di selesai',
            'confirmButtonText' => 'OK',
        ]);

    return redirect()->route('booking.index');
    
    }

    public function show($id_tr_sewa)
    {
        $booking = Sewa::with(['pelanggan','kendaraan'])->findOrFail($id_tr_sewa);
        return view('admin.booking.show', compact('booking'));
    }

    public function detail($id_tr_sewa)
    {
        $sewa = Sewa::with(['pelanggan','payments', 'jaminan'])->findOrFail($id_tr_sewa);

        $tanggalSewa = Carbon::parse($sewa->tanggal_sewa)
            ->locale('id')
            ->translatedFormat('j F Y H:i');

        $jadwalKembali = Carbon::parse($sewa->jadwal_kembali)
            ->locale('id')
            ->translatedFormat('j F Y H:i');

        $tanggalKembali = $sewa->tanggal_kembali ? Carbon::parse($sewa->tanggal_kembali)
            ->locale('id')
            ->translatedFormat('j F Y H:i') : null;

        $latestPayment = $sewa->payments->sortByDesc('created_at')->first();
        $isCash = $latestPayment ? ($latestPayment->payment_type === 'cash') : false;

        return response()->json([
            'id_tr_sewa' => $sewa->id_tr_sewa,
            'pelanggan' => [
            'nama_pelanggan' => $sewa->pelanggan->nama_pelanggan ?? '-',
            ],
            'nopol' => $sewa->nopol,
            'jenis_sewa' => $sewa->jenis_sewa,
            'opsi_pengantaran' => $sewa->opsi_pengantaran,
            'tanggal_sewa' => $tanggalSewa,
            'jadwal_kembali' => $jadwalKembali,
            'tanggal_kembali' => $tanggalKembali,
            'durasi' => $sewa->durasi,
            'harga_sewa' => $sewa->harga_sewa,
            'sub_total' => $sewa->sub_total,
            'biaya_supir' => $sewa->biaya_supir,
            'denda' => $sewa->denda,
            'dp' => $sewa->dp,
            'keterangan' => $latestPayment ? $latestPayment->keterangan : '-',
            'harga_total' => $sewa->harga_total,
            'sisa_tagihan' => $sewa->sisa_tagihan,
            'status' => strtolower(trim($sewa->status)),
            'is_cash' => $isCash, 
            'has_jaminan' => $sewa->jaminan !== null,
            'jaminan'     => $sewa->jaminan,
        ]);
    }

    public function store(Request $request, $nopol)
    {
        $request->validate([
            'tanggal_sewa'     => 'required|date|after_or_equal:'.now()->format('Y-m-d H:i'),
            'tanggal_kembali'  => 'required|date|after_or_equal:tanggal_sewa',
            'jenis_sewa'       => 'required|in:sopir,lepas kunci',
            'opsi_pengantaran' => 'required|in:diantar,tidak',
            'tipe_pembayaran'  => 'required|in:dp,lunas',
            'lokasi_antar'     => 'nullable|string|max:255',
            'keterangan'       => 'nullable|string|max:255',
            'latitude'         => 'nullable', 
            'longitude'        => 'nullable',
        ]);

        $pelanggan = Auth::user()->pelanggan;
        if (!$pelanggan) {
            return redirect()->back()->withErrors(['error' => 'Data pelanggan tidak ditemukan.']);
        }

        $kendaraan = Kendaraan::findOrFail($nopol);

        if (strtolower($kendaraan->status) !== 'free') {
            Swal::warning([
                'title' => 'Gagal',
                'text' => 'Kendaraan tidak tersedia untuk booking.',
                'confirmButtonText' => 'OK',
            ]);
            return back();
        }

        $tgl_mulai   = Carbon::parse($request->tanggal_sewa);
        $tgl_selesai = Carbon::parse($request->jadwal_kembali);
        $totalJam = $tgl_mulai->diffInMinutes($tgl_selesai) / 60;
        $durasi = ceil($totalJam / 24);

        if ($durasi < 1) $durasi = 1;
        $hargaSewa   = $kendaraan->harga * $durasi;
        $biayaSupir  = ($request->jenis_sewa === 'sopir') ? (150000 * $durasi) : 0;
        $grandTotal  = $hargaSewa + $biayaSupir;
        
        if ($request->tipe_pembayaran == 'dp') {
            $jumlahBayar = (int) ($grandTotal * 0.5);
            $sisaTagihan = $grandTotal - $jumlahBayar;
            $statusPembayaran = 'dp';
            $dp = $jumlahBayar;
        } else {
            $jumlahBayar = $grandTotal;
            $sisaTagihan = 0;
            $statusPembayaran = 'lunas';
            $dp = 0;
        }

        $koordinat = null;
        if($request->latitude && $request->longitude){
            $koordinat = $request->latitude. ','. $request->longitude;
        }

        $booking = Sewa::create([
            'id_pelanggan'   => $pelanggan->id_pelanggan,
            'nopol'          => $nopol,
            'jenis_sewa'     => $request->jenis_sewa,
            'tanggal_sewa'   => $request->tanggal_sewa,
            'jadwal_kembali' => $request->tanggal_kembali,
            'durasi'         => $durasi,
            'harga_sewa'     => $kendaraan->harga,
            'sub_total'      => $hargaSewa,
            'biaya_supir'    => $biayaSupir,
            'lokasi_antar'   => $koordinat,
            'harga_total'    => $grandTotal,
            'dp'             => $dp,
            'sisa_tagihan'   => $sisaTagihan,
            'opsi_pengantaran' => $request->opsi_pengantaran,
            'status'         => 'booking',
        ]);

        $orderId = 'INV-' . $booking->id_tr_sewa . '-' . time();
        
        $invoice = $this->generateInvoice($booking);

        Payment::create([
            'order_id'          => $orderId,
            'id_tr_sewa'        => $booking->id_tr_sewa,
            'dp'                => $dp,
            'keterangan'        => $request->keterangan,
            'sisa_bayar'        => $sisaTagihan,
            'jumlah_bayar'      => $jumlahBayar,
            'payment_type'      => 'pending',
            'transaction_status' => 'pending',
            'status_pembayaran' => $statusPembayaran,
        ]);

        return redirect()->route('jaminan.show', $booking->id_tr_sewa)
        ->with('invoice', $invoice);
    }

    public function payment($id_tr_sewa)
    {
        $sewa = Sewa::with('kendaraan')->findOrFail($id_tr_sewa);
        
        if (in_array(strtolower($sewa->status), ['booking', 'dp'])) {
            $payment = Payment::where('id_tr_sewa', $id_tr_sewa)
                ->where('transaction_status', 'pending')
                ->latest()
                ->first();

            if (!$payment) {
                $orderId = 'INV-' . $sewa->id_tr_sewa . '-' . time();
                $payment = Payment::create([
                    'order_id'          => $orderId,
                    'id_tr_sewa'        => $sewa->id_tr_sewa,
                    'dp'                => $sewa->dp,
                    'sisa_bayar'        => $sewa->sisa_tagihan,
                    'jumlah_bayar'      => $sewa->dp > 0 ? $sewa->dp : $sewa->harga_total,
                    'payment_type'      => 'pending',
                    'transaction_status' => 'pending',
                    'status_pembayaran' => $sewa->dp > 0 ? 'dp' : 'lunas',
                ]);
            }

            $invoice = $this->generateInvoice($sewa);
            return view('payment', compact('sewa', 'payment','invoice'));
        }

        if (in_array(strtolower($sewa->status), ['lunas', 'selesai'])) {
            return redirect()->route('home')->with('message', 'Pembayaran sudah selesai.');
        }

        return redirect()->route('home')->with('error', 'Transaksi tidak dapat diproses.');
    }

    public function pelunasan($id_tr_sewa)
    {
        $sewa = Sewa::with('kendaraan')->findOrFail($id_tr_sewa);

        if ($sewa->sisa_tagihan <= 0) {
            return redirect()->route('home')->with('message' , 'Tidak ada sisa tagihan untuk dibayar.');
        }

        $paymentPelunasan = Payment::where('id_tr_sewa', $id_tr_sewa)->where('status_pembayaran', 'lunas')->first();
        
        if (!$paymentPelunasan) {
            $paymentPelunasan = $this->createPelunasanRecord($sewa);
        }

        $payment = $paymentPelunasan;
        $invoice = $this->generateInvoice($sewa);
        return view('pelunasan', compact('sewa', 'payment', 'invoice'));
    }

    private function createPelunasanRecord($sewa)
    {
        $orderId = 'PELUNASAN-' . $sewa->id_tr_sewa . '-' . time();
        
        return Payment::create([
            'order_id' => $orderId,
            'id_tr_sewa' => $sewa->id_tr_sewa,
            'jumlah_bayar' => $sewa->sisa_tagihan,
            'payment_type' => 'cash',
            'transaction_status' => 'pending',
            'keterangan' => null, 
            'status_pembayaran' => 'lunas'
        ]);
    }


    public function chargePayment(Request $request, $id_tr_sewa)
    {
        $sewa = Sewa::findOrFail($id_tr_sewa);
        
        $payment = Payment::where('id_tr_sewa', $id_tr_sewa)
                        ->where('transaction_status', 'pending')
                        ->latest()
                        ->firstOrFail();
                        
        $invoice = $this->generateInvoice($sewa);

        if($request->payment_type === 'cash'){

            $isPelunasan = str_contains($payment->order_id, 'PELUNASAN') || $payment->status_pembayaran === 'lunas';

            $payment->update([
                'payment_type' => 'cash',
                'transaction_status' => 'pending',
                'status_pembayaran' => $isPelunasan ? 'lunas' : 'dp'
            ]);

            return response()->json([
                'status_code' => '200', 
                'message' => 'Silakan lakukan pembayaran di kantor kami.',
                'payment_type' => 'cash',
                'invoice' => $invoice
            ]);
        }


        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $isMandiri = $request->payment_type == 'bank_transfer' && $request->bank == 'mandiri';
        
        if($isMandiri){
            $params = [
                'payment_type' => 'echannel',
                
            'transaction_details' => [
                'order_id' => $payment->order_id,
                'gross_amount' => (int) $payment->jumlah_bayar,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->nama ?? Auth::user()->name, 
                'email' => Auth::user()->email,
            ],
            'echannel' => [
            'bill_info1' => 'Payment For',
            'bill_info2' => 'Rental Kendaraan'
            ]
        
            ];
        }else{      
            $params = [
                'payment_type' => $request->payment_type == 'bank_transfer' ? 'bank_transfer' : $request->payment_type,
                'transaction_details' => [
                    'order_id' => $payment->order_id,
                    'gross_amount' => (int) $payment->jumlah_bayar,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->nama ?? Auth::user()->name, 
                    'email' => Auth::user()->email,
                ],
            ];
    

    
            if ($request->payment_type == 'bank_transfer') {
                $params['bank_transfer'] = [
                    'bank' => $request->bank ?? 'bca',
                ];
            }
        }

        try {
            $response = CoreApi::charge($params);


               $paymentType = $request->payment_type;

                if ($request->payment_type == 'bank_transfer' || $request->payment_type == 'mandiri') {
                    $paymentType = 'va';
                }

        
                $payment->update([
                    'payment_type' => $paymentType,
                    'transaction_status' => 'pending',
                ]);

            $responseArray = json_decode(json_encode($response), true);

            if($isMandiri){
                $responseArray['mandiri'] = [
                      'bill_key' => $responseArray['bill_key'] ?? null,
        'biller_code' => $responseArray['biller_code'] ?? null,
                ];
            }

            $responseArray['invoice'] = $invoice;
            $responseArray['status_code'] = $responseArray['status_code'] ?? '200'; 

            return response()->json($responseArray);
            
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => '500',
                'message' => $e->getMessage()
            ], 500);
        }
    }


   
    public function paymentStatus($id_tr_sewa)
    {
        $sewa = Sewa::find($id_tr_sewa);
        
        if (!$sewa) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $payment = Payment::where('id_tr_sewa', $id_tr_sewa)->latest()->first();

        return response()->json([
            'status' => $sewa->status, 
            'transaction_status' => $payment ? $payment->transaction_status : 'pending',
            'payment_type' => $payment ? $payment->payment_type : '-',
            'order_id' => $payment ? $payment->order_id : '-',
        ]);
    }

    public function midtransCallback(Request $request)
    {
        try {
            $serverKey = config('services.midtrans.serverKey');

            $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashed !== $request->signature_key) {
                Log::warning('Midtrans Callback: Invalid Signature. Order ID: ' . $request->order_id);
                return response()->json(['message' => 'Invalid Signature'], 403);
            }

            $payment = Payment::where('order_id', $request->order_id)->first();
            if (!$payment) {
                Log::error('Midtrans Callback: Payment record not found. Order ID: ' . $request->order_id);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            $sewa = Sewa::find($payment->id_tr_sewa);
            if (!$sewa) {
                Log::error('Midtrans Callback: Sewa record not found. Sewa ID: ' . $payment->id_tr_sewa);
                return response()->json(['message' => 'Sewa not found'], 404);
            }
            
            $paymentTypeMap = [
                'bank_transfer' => 'va',
                'echannel'      => 'va',
                'bca_va'        => 'va',
                'bni_va'        => 'va',
                'bri_va'        => 'va',
                'mandiri_bill'  => 'va',
                'qris'          => 'qris',
                'gopay'         => 'qris',
                'shopeepay'     => 'qris',
            ];

            $mappedPaymentType = $paymentTypeMap[$request->payment_type] ?? $request->payment_type;

            $kendaraan = Kendaraan::where('nopol', $sewa->nopol)->first();
            $statusTransaksi = $request->transaction_status;

            $isPelunasan = (strpos($request->order_id, 'PELUNASAN') !== false) || ($payment->status_pembayaran === 'lunas');

            if ($statusTransaksi == 'capture' || $statusTransaksi == 'settlement') {

                if ($isPelunasan) {
                  
                    $payment->update([
                        'status_pembayaran' => 'lunas',
                        'transaction_status' => 'settlement',
                        'payment_type' => $mappedPaymentType
                    ]);

                    $sewa->update([
                        'status' => 'lunas',
                        'sisa_tagihan' => 0
                    ]);
                    if ($kendaraan) {
                        $kendaraan->update(['status' => 'booking']);
                    }
                } else {

                    $payment->update([
                        'status_pembayaran' => 'dp',
                        'transaction_status' => 'settlement',
                        'payment_type' => $mappedPaymentType
                    ]);

                    $sewa->update(['status' => 'dp']);

                    if ($kendaraan) {
                        $kendaraan->update(['status' => 'booking']);
                    }
                }
            } else if (in_array($statusTransaksi, ['cancel', 'deny', 'expire'])) {
                $payment->update([
                    'status_pembayaran' => 'batal',
                    'transaction_status' => 'cancel'
                ]);

                if (!$isPelunasan) {
                    $sewa->update(['status' => 'batal']);
                    if ($kendaraan) {
                        $kendaraan->update(['status' => 'free']);
                    }
                }
            }

            return response()->json(['message' => 'Callback processed successfully']);
        } catch (\Exception $e) {
            Log::error('MIDTRANS CALLBACK CRASH: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

public function createBooking()
    {
        $kendaraan = Kendaraan::where('status', 'free')->get();
        $pelanggan = Pelanggan::with('user')->get();
        return view('admin.booking.create', compact('kendaraan', 'pelanggan'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'id_pelanggan'    => 'required|exists:ms_pelanggan,id_pelanggan',
            'nopol'           => 'required|exists:ms_kendaraan,nopol',
            'tanggal_sewa'    => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'jenis_sewa'      => 'required|in:sopir,lepas kunci',
            'opsi_pengantaran'=> 'required|in:diantar,tidak',
            'tipe_pembayaran' => 'required|in:dp,lunas',
        ]);

        $kendaraan = Kendaraan::findOrFail($request->nopol);

        if (strtolower($kendaraan->status) !== 'free') {
            return redirect()->back()->with('error', 'Kendaraan tidak tersedia.');
        }

        $tgl_mulai   = Carbon::parse($request->tanggal_sewa);
        $tgl_selesai = Carbon::parse($request->tanggal_kembali);
        $totalJam    = $tgl_mulai->diffInMinutes($tgl_selesai) / 60;
        $durasi      = max(1, ceil($totalJam / 24));

        $hargaSewa  = $kendaraan->harga * $durasi;
        $biayaSupir = ($request->jenis_sewa === 'sopir') ? (150000 * $durasi) : 0;
        $grandTotal = $hargaSewa + $biayaSupir;

        if ($request->tipe_pembayaran === 'dp') {
            $jumlahBayar      = (int) ($grandTotal * 0.5);
            $sisaTagihan      = $grandTotal - $jumlahBayar;
            $statusPembayaran = 'dp';
            $dp               = $jumlahBayar;
        } else {
            $jumlahBayar      = $grandTotal;
            $sisaTagihan      = 0;
            $statusPembayaran = 'lunas';
            $dp               = 0;
        }

        $booking = Sewa::create([
            'id_pelanggan'     => $request->id_pelanggan,
            'nopol'            => $request->nopol,
            'jenis_sewa'       => $request->jenis_sewa,
            'tanggal_sewa'     => $request->tanggal_sewa,
            'jadwal_kembali'   => $request->tanggal_kembali,
            'durasi'           => $durasi,
            'harga_sewa'       => $kendaraan->harga,
            'sub_total'        => $hargaSewa,
            'biaya_supir'      => $biayaSupir,
            'harga_total'      => $grandTotal,
            'dp'               => $dp,
            'sisa_tagihan'     => $sisaTagihan,
            'opsi_pengantaran' => $request->opsi_pengantaran,
            'lokasi_antar'     => null,
            'status'           => 'booking',
        ]);

        $orderId = 'INV-' . $booking->id_tr_sewa . '-' . time();

        Payment::create([
            'order_id'           => $orderId,
            'id_tr_sewa'            => $booking->id_tr_sewa,
            'jumlah_bayar'       => $jumlahBayar,
            'payment_type'       => 'cash',
            'transaction_status' => 'pending',
            'status_pembayaran'  => $statusPembayaran,
        ]);

        $kendaraan->update(['status' => 'booking']);


        return redirect()->route('booking.admin.jaminan', $booking->id_tr_sewa);
    }

    public function adminPaymentPage($id_tr_sewa)
        {
            $sewa = Sewa::with('kendaraan')->findOrFail($id_tr_sewa);
            
            $payment = Payment::where('id_tr_sewa', $id_tr_sewa)
                ->where('status_pembayaran', 'dp')
                ->latest()
                ->first();

            if (!$payment) {
                $orderId = 'INV-' . $sewa->id_tr_sewa . '-' . time();
                $payment = Payment::create([
                    'order_id'           => $orderId,
                    'id_tr_sewa'            => $sewa->id_tr_sewa,
                    'jumlah_bayar'       => $sewa->dp > 0 ? $sewa->dp : $sewa->harga_total,
                    'payment_type'       => 'cash',
                    'transaction_status' => 'pending',
                    'status_pembayaran'  => $sewa->dp > 0 ? 'dp' : 'lunas',
                ]);
            }

            $invoice = $this->generateInvoice($sewa);
            return view('admin.booking.payment', compact('sewa', 'payment', 'invoice'));
        }

    public function adminPelunasanPage($id_tr_sewa)
        {
            $sewa = Sewa::with('kendaraan')->findOrFail($id_tr_sewa);

            $payment = Payment::where('id_tr_sewa', $id_tr_sewa)
                ->where('status_pembayaran', 'lunas')
                ->latest()
                ->first();

            if (!$payment) {
                $orderId = 'PELUNASAN-' . $sewa->id_tr_sewa . '-' . time();
                $payment = Payment::create([
                    'order_id'           => $orderId,
                    'id_tr_sewa'         => $sewa->id_tr_sewa,
                    'jumlah_bayar'       => $sewa->sisa_tagihan,
                    'payment_type'       => 'cash',
                    'transaction_status' => 'pending',
                    'status_pembayaran'  => 'lunas',
                ]);
            }

            $invoice = $this->generateInvoice($sewa);

            return view('admin.booking.pelunasan', compact('sewa', 'payment', 'invoice'));
        }

}