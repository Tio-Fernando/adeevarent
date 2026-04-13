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

        $payment = Payment::where('sewa_id', $id)
            ->where('transaction_status', 'pending')
            ->latest()
            ->first();

        if (!$payment) {
            return back()->with('error', 'Tidak ada pembayaran pending');
        }

      
        if ($sewa->sisa_tagihan > 0) {

            $payment->update([
                'status_pembayaran' => 'dp',
                'transaction_status' => 'settlement'
            ]);

       
            $sewa->update([
                'sisa_tagihan' => $sewa->harga_total - $payment->jumlah_bayar
            ]);
        } else {

            $payment->update([
                'status_pembayaran' => 'lunas',
                'transaction_status' => 'settlement'
            ]);

            $sewa->update([
                'status' => 'lunas',
                'sisa_tagihan' => 0
            ]);
        }

          Swal::success([
            'title' => 'Berhasil',
            'text' => 'Konfirmasi Berhasil',
            'confirmButtonText' => 'OK',
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}
