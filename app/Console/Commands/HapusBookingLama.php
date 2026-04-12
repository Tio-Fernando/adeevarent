<?php

namespace App\Console\Commands;

use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('app:booking-bersihkan')]
#[Description('Command description')]
class HapusBookingLama extends Command
{
    /**
     * Execute the console command.
     */
  public function handle()
{
    $ambangWaktu = Carbon::now()->subMinutes(15);

    // Ambil data sewa yang expired
    $sewas = Sewa::where('status', 'Booking')
        ->where('created_at', '<', $ambangWaktu)
        ->get();

    if ($sewas->isEmpty()) {
        $this->info('Tidak ada data booking yang kedaluwarsa.');
        return;
    }

    DB::beginTransaction();

    try {
        foreach ($sewas as $sewa) {
            // 1. Hapus payment terkait
            Payment::where('sewa_id', $sewa->id)->delete();

            Kendaraan::where('nopol', $sewa->nopol) // sesuaikan field relasi
                ->update(['status' => 'free']);


            $sewa->delete();
        }

        DB::commit();
        $this->info(count($sewas) . ' booking berhasil dibersihkan.');
        
    } catch (\Exception $e) {
        DB::rollback();
        $this->error('Gagal: ' . $e->getMessage());
    }
}
}
