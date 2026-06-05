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
        try {
            $sewa = Sewa::findOrFail($id);    
            if (strtolower($sewa->status) !== 'booking') {
                $message = 'Status sewa bukan Booking';
                if (request()->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }
                return back()->with('error', $message);
            }
            $kendaraan = $sewa->kendaraan;
            if (!$kendaraan) {
                $message = 'Kendaraan tidak ditemukan untuk sewa ini';
                if (request()->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }
                return back()->with('error', $message);
            }
            
            $payment = Payment::where('id_tr_sewa', $id)
                ->where('transaction_status', 'pending')
                ->where('status_pembayaran', 'dp')
                ->latest()
                ->first();

            if (!$payment) {
                $message = 'Tidak ada pembayaran pending';
                if (request()->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }
                return back()->with('error', $message);
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

            $message = 'DP berhasil dikonfirmasi';
            if (request()->expectsJson()) {
                return response()->json(['message' => $message, 'success' => true], 200);
            }

            Swal::success([
                'title'             => 'Berhasil',
                'text'              => 'Konfirmasi DP Berhasil',
                'confirmButtonText' => 'OK',
            ]);

            return back()->with('success', $message);
        } catch (\Exception $e) {
            $message = 'Terjadi kesalahan: ' . $e->getMessage();
            if (request()->expectsJson()) {
                return response()->json(['message' => $message], 500);
            }
            return back()->with('error', $message);
        }
    }

    public function konfirmasiLunas($id)
    {
        try {
            $sewa = Sewa::findOrFail($id);

            if ($sewa->status !== 'dp') {
                $message = 'Status sewa bukan dp, status saat ini: ' . $sewa->status;
                if (request()->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }
                return back()->with('error', $message);
            }

            $kendaraan = $sewa->kendaraan;
            if (!$kendaraan) {
                $message = 'Kendaraan tidak ditemukan untuk sewa ini';
                if (request()->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }
                return back()->with('error', $message);
            }
            $payment = Payment::where('id_tr_sewa', $id)
                ->where('transaction_status', 'pending')
                ->where('status_pembayaran', 'lunas')
                ->latest()
                ->first();

            if (!$payment) {
                $message = 'Tidak ada pembayaran DP yang bisa dilunasi';
                if (request()->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }
                return back()->with('error', $message);
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

            $message = 'Pelunasan berhasil dikonfirmasi';
            if (request()->expectsJson()) {
                return response()->json(['message' => $message, 'success' => true], 200);
            }

            Swal::success([
                'title'             => 'Berhasil',
                'text'              => 'Konfirmasi Pelunasan Berhasil',
                'confirmButtonText' => 'OK',
            ]);

            return back()->with('success', $message);
        } catch (\Exception $e) {
            $message = 'Terjadi kesalahan: ' . $e->getMessage();
            if (request()->expectsJson()) {
                return response()->json(['message' => $message], 500);
            }
            return back()->with('error', $message);
        }
    }

    public function batal($id)
    {
        $sewa = Sewa::findOrFail($id);

        if (!in_array($sewa->status, ['lunas', 'dp'])) {
            return back()->with('error', 'Hanya pesanan dengan status DP atau lunas yang dapat dibatalkan.');
        }

        $kendaraan = $sewa->kendaraan;
        if (!$kendaraan) {
            return back()->with('error', 'Data kendaraan tidak ditemukan.');
        }

        $payment = Payment::where('id_tr_sewa', $id)->latest()->first();
        if ($payment) {
            $payment->update([
                'transaction_status' => 'cancel',
                'status_pembayaran'  => 'batal'
            ]);
        }

        $kendaraan->update(['status' => 'free']);

        $sewa->update([
            'status' => 'batal',
            'sisa_tagihan' => 0
        ]);

        Swal::success([
            'title'             => 'Batal',
            'text'              => 'Pesanan telah dibatalkan',
            'confirmButtonText' => 'OK',
        ]);

        return back()->with('success', 'Pesanan berhasil dibatalkan');
    }


}
