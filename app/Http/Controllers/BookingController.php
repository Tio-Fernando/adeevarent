<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\CoreApi;
use SweetAlert2\Laravel\Swal;

class BookingController extends Controller
{
    public function index(){
        $booking = Sewa::with('payments')->paginate(10);
        
        return view('admin.booking.index',compact('booking'));
    }
    
    public function selesai(Request $request,$id){
        $sewa = Sewa::with('kendaraan')->findOrFail($id);
        if ($sewa->status !== 'lunas') {
        return redirect()->back()->with('error', 'Pesanan harus dilunasi terlebih dahulu.');
    }

    $pengembalian = Carbon::now();
    $jadwalKembali = Carbon::parse($sewa->jadwal_kembali);
    $denda = 0;

    if ($pengembalian->greaterThan($jadwalKembali)) {
        $lateHours = $jadwalKembali->diffInHours($pengembalian);

        // Tambahkan pembulatan ke atas jika masih ada sisa menit
        if ($jadwalKembali->copy()->addHours($lateHours)->lessThan($pengembalian)) {
            $lateHours++;
        }

        $dendaPerJam = $sewa->kendaraan->denda_terlambat;
        $denda = $lateHours * $dendaPerJam;
    }

    $sewa->update([
        'status' => 'selesai',
        'tgl_kembali' => $pengembalian,
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

    public function show($id)
    {
        $booking = Sewa::with(['pelanggan','kendaraan'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function detail($id)
    {
        $sewa = Sewa::with('pelanggan')->findOrFail($id);

        $tanggalSewa = Carbon::parse($sewa->tgl_sewa)
            ->locale('id')
            ->translatedFormat('j F Y H:i');

        $jadwalKembali = Carbon::parse($sewa->jadwal_kembali)
            ->locale('id')
            ->translatedFormat('j F Y H:i');

        $tanggalKembali = $sewa->tgl_kembali ? Carbon::parse($sewa->tgl_kembali)
            ->locale('id')
            ->translatedFormat('j F Y H:i') : null;

        return response()->json([
            'id' => $sewa->id,
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
            'harga_total' => $sewa->harga_total,
            'sisa_tagihan' => $sewa->sisa_tagihan,
            'status' => $sewa->status,
        ]);
    }

    public function store(Request $request, $nopol)
    {
        $request->validate([
            'tgl_sewa'         => 'required|date|after_or_equal:now',
            'jadwal_kembali'   => 'required|date|after_or_equal:tgl_sewa',
            'jenis_sewa'       => 'required|in:sopir,lepas kunci',
            'opsi_pengantaran' => 'required|in:diantar,tidak',
            'lokasi_antar'    => 'nullable|string|max:255',
            'latitude'  => 'nullable', 
            'longitude' => 'nullable',
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

        $tgl_mulai   = Carbon::parse($request->tgl_sewa);
        $tgl_selesai = Carbon::parse($request->jadwal_kembali);
        $totalJam = $tgl_mulai->diffInMinutes($tgl_selesai) / 60;
        $durasi = ceil($totalJam / 24);

        if ($durasi < 1) $durasi = 1;
        $hargaSewa   = $kendaraan->harga * $durasi;
        $biayaSupir  = ($request->jenis_sewa === 'sopir') ? (150000 * $durasi) : 0;
        $grandTotal  = $hargaSewa + $biayaSupir;
        $dpWajib     = (int) ($grandTotal * 0.5);
        $sisaTagihan = $grandTotal - $dpWajib;

        $koordinat = null;
        if($request->latitude && $request->longitude){
            $koordinat = $request->latitude. ','. $request->longitude;
        }

        $booking = Sewa::create([
            'pelanggan_id'   => $pelanggan->id,
            'nopol'          => $nopol,
            'jenis_sewa'     => $request->jenis_sewa,
            'tgl_sewa'       => $request->tgl_sewa,
            'jadwal_kembali' => $request->jadwal_kembali,
            'durasi'         => $durasi,
            'harga_sewa'     => $kendaraan->harga,
            'sub_total'      => $hargaSewa,
            'biaya_supir'    => $biayaSupir,
            'lokasi_antar'  => $koordinat,
            'harga_total'    => $grandTotal,
            'dp'             => $dpWajib,
            'sisa_tagihan'   => $sisaTagihan,
            'opsi_pengantaran' => $request->opsi_pengantaran,
            'status'         => 'Booking',
        ]);

   
     

        $orderId = 'INV-' . $booking->id . '-' . time();


        Payment::create([
            'order_id'          => $orderId,
            'sewa_id'           => $booking->id,
            'snap_token'        => '-', 
            'dp'                => $dpWajib,
            'sisa_bayar'        => $sisaTagihan,
            'jumlah_bayar'      => $dpWajib,
            'payment_type'      => 'cash',
            'transaction_status' => 'pending',
            'status_pembayaran' => 'dp',
        ]);

        return redirect()->route('payment', $booking->id);
    }

    public function payment($id)
    {
        $sewa = Sewa::with('kendaraan')->findOrFail($id);
        
        if ($sewa->sisa_tagihan > 0) {
            $payment = Payment::where('sewa_id', $id)
                ->where('status_pembayaran', 'dp')
                ->first();

            // Jika payment record belum ada, buat satu
            if (!$payment) {
                $orderId = 'INV-' . $sewa->id . '-' . time();
                $payment = Payment::create([
                    'order_id'          => $orderId,
                    'sewa_id'           => $sewa->id,
                    'snap_token'        => '-', 
                    'dp'                => $sewa->dp,
                    'sisa_bayar'        => $sewa->sisa_tagihan,
                    'jumlah_bayar'      => $sewa->dp,
                    'payment_type'      => 'pending',
                    'transaction_status' => 'pending',
                    'status_pembayaran' => 'dp',
                ]);
              
            }

            return view('payment', compact('sewa', 'payment'));
        }

        if (strtolower($sewa->status) === 'lunas' || strtolower($sewa->status) === 'selesai') {
            return redirect()->route('home')->with('message', 'Pembayaran sudah selesai.');
        }

        return redirect()->route('home')->with('error', 'Transaksi tidak dapat diproses.');
    }

    public function pelunasan($id)
    {
        $sewa = Sewa::with('kendaraan')->findOrFail($id);

        if ($sewa->sisa_tagihan <= 0) {
            return redirect()->route('home')->with('message', 'Tidak ada sisa tagihan untuk dibayar.');
        }

        $paymentPelunasan = Payment::where('sewa_id', $id)->where('status_pembayaran', 'lunas')->first();
        
        if (!$paymentPelunasan) {
            $paymentPelunasan = $this->createPelunasanRecord($sewa);
        }

        $payment = $paymentPelunasan;
        return view('pelunasan', compact('sewa', 'payment'));
    }

    private function createPelunasanRecord($sewa)
    {
        $orderId = 'PELUNASAN-' . $sewa->id . '-' . time();
        
        return Payment::create([
            'order_id' => $orderId,
            'sewa_id' => $sewa->id,
            'snap_token' => '-', 
            'jumlah_bayar' => $sewa->sisa_tagihan,
            'payment_type' => 'cash',
            'transaction_status' => 'pending',
            'status_pembayaran' => 'dp'
        ]);
    }

   

      public function chargePayment(Request $request, $id)
    {
        $sewa = Sewa::findOrFail($id);
        
        $payment = Payment::where('sewa_id', $id)
                          ->where('transaction_status', 'pending')
                          ->latest()
                          ->firstOrFail();


        if($request->payment_type === 'cash'){
            $payment->update([
                'status_pembayaran' => str_contains($payment->order_id, 'PELUNASAN') ? 'lunas' : 'dp'
            ]);

            return response()->json([
                'status_code' => '200',
                'message' => 'Silakan lakukan pembayaran di kantor kami.',
            'payment_type' => 'cash'
            ]);

        }

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'payment_type' => $request->payment_type == 'bank_transfer' ? 'bank_transfer' : $request->payment_type,
            'transaction_details' => [
                'order_id' => $payment->order_id,
                'gross_amount' => (int) $payment->jumlah_bayar,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        if ($request->payment_type == 'bank_transfer') {
            $params['bank_transfer'] = [
                'bank' => $request->bank ?? 'bca',
            ];
        }

        try {
            $response = CoreApi::charge($params);

            $payment->update([
                'payment_type' => $request->payment_type == 'bank_transfer' ? 'va' : $request->payment_type,
                'transaction_status' => 'pending',
            ]);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    // FUNGSI INI DIBIKIN LEBIH AMAN AGAR TIDAK ERROR 500
    public function paymentStatus($id)
    {
        $sewa = Sewa::find($id);
        
        if (!$sewa) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $payment = Payment::where('sewa_id', $id)->latest()->first();

        return response()->json([
            'status' => $sewa->status, // Mengambil status langsung dari tabel sewa
            'transaction_status' => $payment ? $payment->transaction_status : 'pending',
            'payment_type' => $payment ? $payment->payment_type : '-',
            'order_id' => $payment ? $payment->order_id : '-',
        ]);
    }

    public function midtransCallback(Request $request)
    {
        try {
            $serverKey = config('services.midtrans.serverKey');

            // Gunakan gross_amount langsung dari request agar presisi desimalnya sama dengan kiriman Midtrans
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

            $sewa = Sewa::find($payment->sewa_id);
            if (!$sewa) {
                Log::error('Midtrans Callback: Sewa record not found. Sewa ID: ' . $payment->sewa_id);
                return response()->json(['message' => 'Sewa not found'], 404);
            }

            $kendaraan = Kendaraan::where('nopol', $sewa->nopol)->first();
            $statusTransaksi = $request->transaction_status;

            // Gunakan strpos sebagai pengganti str_contains untuk keamanan versi PHP
            $isPelunasan = (strpos($request->order_id, 'PELUNASAN') !== false) || ($payment->status_pembayaran === 'lunas');

            if ($statusTransaksi == 'capture' || $statusTransaksi == 'settlement') {

                if ($isPelunasan) {
                    // UPDATE PELUNASAN
                    $payment->update([
                        'status_pembayaran' => 'lunas',
                        'transaction_status' => 'settlement',
                        'payment_type' => $request->payment_type
                    ]);

                    $sewa->update([
                        'status' => 'lunas',
                        'sisa_tagihan' => 0
                    ]);
                } else {
                    // UPDATE DP / BOOKING AWAL
                    $payment->update([
                        'status_pembayaran' => 'dp',
                        'transaction_status' => 'settlement',
                        'payment_type' => $request->payment_type
                    ]);

                    $sewa->update(['status' => 'Booking']);

                    if ($kendaraan) {
                        $kendaraan->update(['status' => 'booking']);
                    }
                }
            } else if (in_array($statusTransaksi, ['cancel', 'deny', 'expire'])) {
                $payment->update([
                    'status_pembayaran' => 'gagal',
                    'transaction_status' => 'cancel'
                ]);

                if (!$isPelunasan) {
                    $sewa->update(['status' => 'Batal']);
                    if ($kendaraan) {
                        $kendaraan->update(['status' => 'free']);
                    }
                }
            }

            return response()->json(['message' => 'Callback processed successfully']);
        } catch (\Exception $e) {
            // Ini akan mencatat error sebenarnya di storage/logs/laravel.log
            Log::error('MIDTRANS CALLBACK CRASH: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}