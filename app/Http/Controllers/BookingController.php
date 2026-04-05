<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\Sewa;
use Carbon\Carbon;
use Dom\Comment;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Snap;
use SweetAlert2\Laravel\Swal;

class BookingController extends Controller
{
    public function index(){
        return view('admin.booking.index');
    }
    
    public function show(){
        return view('detail');
    }

   public function store(Request $request, $nopol)
{
    $request->validate([
        'tgl_sewa'         => 'required|date',
        'jadwal_kembali'   => 'required|date|after_or_equal:tgl_sewa',
        'jenis_sewa'       => 'required|in:sopir,lepas kunci',
        'opsi_pengantaran' => 'required|in:diantar,tidak',
        'lokasi_jemput'    => 'nullable|string|max:255',
    ]);

   
    $pelanggan = Auth::user()->pelanggan;
    if (!$pelanggan) {
        return redirect()->back()->withErrors(['error' => 'Data pelanggan tidak ditemukan.']);
    }

    $kendaraan = Kendaraan::findOrFail($nopol);

    $tgl_mulai   = Carbon::parse($request->tgl_sewa);
    $tgl_selesai = Carbon::parse($request->jadwal_kembali);
    $durasi      = $tgl_mulai->diffInDays($tgl_selesai) + 1;
    if ($durasi < 1) $durasi = 1;

    $hargaSewa   = $kendaraan->harga * $durasi;
    $biayaSupir  = ($request->jenis_sewa === 'sopir') ? (150000 * $durasi) : 0;
    $biayaAntar  = ($request->opsi_pengantaran === 'diantar') ? 50000 : 0;
    $grandTotal  = $hargaSewa + $biayaSupir + $biayaAntar;
    $dpWajib     = (int) ($grandTotal * 0.5);
    $sisaTagihan = $grandTotal - $dpWajib;
    $lokasiJemput = ($request->opsi_pengantaran === 'diantar') ? $request->lokasi_jemput : null;

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
        'biaya_antar'    => $biayaAntar,
        'lokasi_jemput'  => $lokasiJemput,
        'lokasi_kembali' => $lokasiJemput,
        'harga_total'    => $grandTotal,
        'dp'             => $dpWajib,
        'sisa_tagihan'   => $sisaTagihan,
        'opsi_pengantaran' => $request->opsi_pengantaran,
        'status'         => 'Booking',
    ]);

    Config::$serverKey    = config('services.midtrans.serverKey');
    Config::$isProduction = config('services.midtrans.isProduction');
    Config::$isSanitized  = true;
    Config::$is3ds        = true;

    $orderId = 'INV-' . $booking->id . '-' . time();

    $params = [
        'transaction_details' => [
            'order_id'     => $orderId,
            'gross_amount' => $dpWajib,
        ],
        'customer_details' => [
            'first_name' => Auth::user()->name,
            'email'      => Auth::user()->email,
        ],
        'item_details' => [[
            'id'       => $nopol,
            'price'    => $dpWajib,
            'quantity' => 1,
            'name'     => 'DP Sewa - ' . $kendaraan->nama_kendaraan,
        ]],
    ];

    $snapToken = Snap::getSnapToken($params);

    Payment::create([
        'order_id'          => $orderId,
        'sewa_id'           => $booking->id,
        'snap_token'        => $snapToken,
        'jumlah_bayar'      => $dpWajib,
         'payment_type'      => 'midtrans',
        'status_pembayaran' => 'pending',
    ]);

    return redirect()->route('payment', $booking->id);
}

    public function payment($id)
    {
        $sewa = Sewa::with('kendaraan')->findOrFail($id);
        $payment = Payment::where('sewa_id', $id)->firstOrFail();

        return view('payment', compact('sewa', 'payment'));
    }

public function chargePayment(Request $request, $id)
    {
  
        $sewa = Sewa::findOrFail($id);
        $payment = Payment::where('sewa_id', $id)->first();

        // 2. Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $payment->order_id,
                'gross_amount' => (int)$payment->jumlah_bayar,
            ],
            'customer_details' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

      
        if ($request->payment_type == 'qris') {
            $params['payment_type'] = 'qris';
          
        } 
        elseif ($request->payment_type == 'bank_transfer') {
            $params['payment_type'] = 'bank_transfer';
            $params['bank_transfer'] = [
                'bank' => $request->bank ?? 'bca', // Default ke BCA jika tidak pilih
            ];
        }

        try {
            // 5. Eksekusi ke Midtrans (Core API)
            $response = CoreApi::charge($params);
            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => '500',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function midtransCallback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
       
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            $payment = Payment::where('order_id', $request->order_id)->first();
            
            if ($payment) {
                $sewa = Sewa::find($payment->sewa_id);
                $kendaraan = Kendaraan::where('nopol', $sewa->nopol)->first();

                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $payment->update(['status_pembayaran' => 'Lunas']);
                    $sewa->update(['status' => 'Dibayar']); 
                    
                    // BARU KITA KUNCI MOBILNYA DI SINI!
                    if ($kendaraan && $kendaraan->status !== 'booked') {
                        $kendaraan->update(['status' => 'booked']);
                    }
                } 
                
                // JIKA PEMBAYARAN GAGAL / KEDALUWARSA / DIBATALKAN
                else if ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                    $payment->update(['status_pembayaran' => 'Gagal']);
                    $sewa->update(['status' => 'Dibatalkan']);
                    
                    // Tidak perlu mengubah status kendaraan ke free
                    // Karena dari awal memang belum kita ubah ke booked
                }
            }
        }
        
        return response()->json(['message' => 'Callback received']);
    }
}
