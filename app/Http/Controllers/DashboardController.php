<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Sewa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKendaraan = Kendaraan::count();

        $kendaraanBooking = Kendaraan::where('status', 'Booking')
            ->pluck('nopol')
            ->unique()
            ->count();
            

        $user = User::where('level', 'Pelanggan')
            ->count();

        $totalOrder = Sewa::count();

        $totalSelesai = Sewa::where('status', 'selesai')
            ->count();

        $freeKendaraan = $totalKendaraan - $kendaraanBooking;

        $bookingTerbaru = Sewa::with(['pelanggan','payments','kendaraan'])
                        ->latest()
                        ->paginate(3);

        $chart = Sewa::select(
            DB::raw('MONTH(tanggal_sewa) as bulan'),
            DB::raw("
                    SUM(
                        CASE
                            WHEN status = 'selesai'
                            THEN 1
                            ELSE 0
                        END
                    ) as selesai
                ")
        )
            ->whereNotNull('tanggal_sewa')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $labels = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $selesaiData = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            if ($chart->has($bulan)) {
                $selesaiData[] = (int) $chart->get($bulan)->selesai;
            } else {
                $selesaiData[] = 0;
            }
        }

        return view('dashboard', compact(
            'totalKendaraan',
            'freeKendaraan',
            'user',
            'totalOrder',
            'bookingTerbaru',
            'totalSelesai',
            'labels',
            'selesaiData'
        ));
    }
}