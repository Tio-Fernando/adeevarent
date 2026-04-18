<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Sewa;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class AdminPaymentController extends Controller
{
    public function konfirmasi($id)
    {
        $sewa = Sewa::findOrFail($id);

    
        if ($sewa->status !== 'booking') {
            return back()->with('error', 'Status sewa bukan booking');
        }
        $kendaraan = $sewa->kendaraan;
        if (!$kendaraan) {
            return back()->with('error', 'Kendaraan tidak ditemukan untuk sewa ini');
        }
        
        $payment = Payment::where('sewa_id', $id)
            ->where('transaction_status', 'pending')
            ->latest()
            ->first();

        if (!$payment) {
            return back()->with('error', 'Tidak ada pembayaran pending');
        }

        $dp = $sewa->harga_total / 2;

        $payment->update([
            'dp'                 => $dp,
            'status_pembayaran'  => 'dp',
            'transaction_status' => 'settlement',
        ]);

        $kendaraan->update(['status' => 'booking']);
        
        $sewa->update([
            'status'       => 'dp',
            'dp'           => $dp,
            'sisa_tagihan' => $dp,
        ]);

        Swal::success([
            'title'             => 'Berhasil',
            'text'              => 'Konfirmasi DP Berhasil',
            'confirmButtonText' => 'OK',
        ]);

        return back()->with('success', 'DP berhasil dikonfirmasi');
    }

    public function konfirmasiLunas($id)
    {
        $sewa = Sewa::findOrFail($id);

        if ($sewa->status !== 'dp') {
            return back()->with('error', 'Status sewa bukan dp, status saat ini: ' . $sewa->status);
        }

        $kendaraan = $sewa->kendaraan;
        if (!$kendaraan) {
            return back()->with('error', 'Kendaraan tidak ditemukan untuk sewa ini');
        }
        $payment = Payment::where('sewa_id', $id)
            ->where('transaction_status', 'settlement')
            ->where('status_pembayaran', 'dp')
            ->latest()
            ->first();

        if (!$payment) {
            return back()->with('error', 'Tidak ada pembayaran DP yang bisa dilunasi');
        }

        $payment->update([
            'status_pembayaran'  => 'lunas',
            'transaction_status' => 'settlement',
            'sisa_bayar'         => 0,
        ]);

        $sewa->update([
            'status'       => 'lunas',
            'sisa_tagihan' => 0,
        ]);

        Swal::success([
            'title'             => 'Berhasil',
            'text'              => 'Konfirmasi Pelunasan Berhasil',
            'confirmButtonText' => 'OK',
        ]);

        return back()->with('success', 'Pelunasan berhasil dikonfirmasi');
    }
}
