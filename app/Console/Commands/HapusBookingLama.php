<?php

namespace App\Console\Commands;

use App\Models\Jaminan;
use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('app:booking-bersihkan')]
#[Description('Hapus booking yang sudah kedaluwarsa')]
class HapusBookingLama extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('Cron booking berjalan: ' . now());
        // Ambil semua booking
        $sewas = Sewa::where('status', 'Booking')->get();

        if ($sewas->isEmpty()) {
            $this->info('Tidak ada data booking.');
            return;
        }

        $jumlahDihapus = 0;

        DB::beginTransaction();

        try {
            foreach ($sewas as $sewa) {

                // Ambil payment terkait
                $payment = Payment::where('id_tr_sewa', $sewa->id_tr_sewa)->first();

                // Default expired 15 menit
                $batasWaktu = Carbon::parse($sewa->created_at)->addMinutes(15);

                // Jika pembayaran cash → 24 jam
                if ($payment && $payment->payment_type === 'cash') {
                    $batasWaktu = Carbon::parse($sewa->created_at)->addHours(24);
                }

                // Cek apakah sudah expired
                if (Carbon::now()->greaterThan($batasWaktu)) {

                    // Hapus payment terkait
                    if ($payment) {
                        $payment->delete();
                    }

                    Jaminan::where('id_tr_sewa', $sewa->id_tr_sewa)->delete();

                    // Ubah status kendaraan jadi free
                    Kendaraan::where('nopol', $sewa->nopol)
                        ->update(['status' => 'free']);

                    // Hapus sewa
                    $sewa->delete();

                    $jumlahDihapus++;
                }
            }

            DB::commit();

            $this->info($jumlahDihapus . ' booking berhasil dibersihkan.');
        } catch (\Exception $e) {

            DB::rollback();

            $this->error('Gagal: ' . $e->getMessage());
        }
    }
}
