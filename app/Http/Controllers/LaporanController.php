<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\Sewa;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $pendapatanBulanIni = Payment::whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->whereIn('transaction_status', ['settlement', 'capture','cancel'])
                        ->sum('jumlah_bayar');

        $totalTransaksi = Sewa::whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->count();

        $mobilTersedia = Kendaraan::where('status','free')->count();
        $totalMobil = Kendaraan::count();
        
        $laporan = Sewa::with('pelanggan','kendaraan')
            ->whereIn('status',['dp','lunas','selesai'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->when($search, function ($query) use ($search) {
                return $query->where('nopol', 'like', '%' . $search . '%')
                    ->orWhere('id_tr_sewa', 'like', '%' . $search . '%')
                    ->orWhereHas('pelanggan', function ($q) use ($search) {
                        $q->where('nama_pelanggan', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('kendaraan', function ($q) use ($search) {
                        $q->where('nama_kendaraan', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.laporan.index',
            compact('pendapatanBulanIni',
            'totalTransaksi',
            'mobilTersedia',
            'totalMobil',
            'laporan',
            'bulan',
            'tahun',
            'search'));
    }

    public function superIndex(Request $request){
        $search = $request->get('search');
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $pendapatanBulanIni = Payment::whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->whereIn('transaction_status', ['settlement', 'capture','cancel'])
                        ->sum('jumlah_bayar');

        $totalTransaksi = Sewa::whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->count();

        $mobilTersedia = Kendaraan::where('status','free')->count();
        $totalMobil = Kendaraan::count();
        
        $laporan = Sewa::with('pelanggan','kendaraan')
            ->whereIn('status',['dp','lunas','selesai'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->when($search, function ($query) use ($search) {
                return $query->where('nopol', 'like', '%' . $search . '%')
                    ->orWhere('id_tr_sewa', 'like', '%' . $search . '%')
                    ->orWhereHas('pelanggan', function ($q) use ($search) {
                        $q->where('nama_pelanggan', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('kendaraan', function ($q) use ($search) {
                        $q->where('nama_kendaraan', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('owner.laporan',
            compact('pendapatanBulanIni',
            'totalTransaksi',
            'mobilTersedia',
            'totalMobil',
            'laporan',
            'bulan',
            'tahun',
            'search'));
    }

    public function exportExcel(Request $request){
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $namaFile = 'Laporan-Adeva-' . $bulan . '-' . $tahun . '.xlsx';
        return Excel::download(
            new LaporanExport($bulan,$tahun),
            $namaFile
        );
    }
}