<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Sewa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKendaraan = Kendaraan::count();
        
        $kendaraanBooking = Sewa::where('status', 'booking')
            ->pluck('nopol')
            ->unique()
            ->count();
        

        $freeKendaraan = $totalKendaraan - $kendaraanBooking;
        
        return view('dashboard', compact('totalKendaraan', 'freeKendaraan'));
    }
}
