<?php

namespace App\Exports;

use App\Models\Sewa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;  

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan; 
        $this->tahun = $tahun;
    }

    public function collection()
    {
      
        return Sewa::with(['pelanggan', 'kendaraan'])
            ->whereMonth('created_at', $this->bulan)
            ->whereYear('created_at', $this->tahun)
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'No Pol',
            'Nama Pelanggan',
            'Jenis Sewa',
            'Tanggal Sewa',
            'Tanggal Kembali',
            'Jadwal Kembali',
            'Durasi (Hari)',
            'Harga Sewa',
            'Total Bayar',
            'Status'
        ];
    }

    public function map($sewa): array
    {
       
        return [
            $sewa->nopol,
            $sewa->pelanggan->nama_pelanggan ?? 'Umum',
            $sewa->jenis_sewa,
            $sewa->tanggal_sewa,
            $sewa->tanggal_kembali,
            $sewa->jadwal_kembali,
            $sewa->durasi,
            'Rp ' . number_format($sewa->harga_total, 0, ',', '.'),
            'Rp ' . number_format($sewa->sub_total, 0, ',', '.'),
            $sewa->status,
        ];
    }
}