<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $table = 'sewa';
    protected $fillable = [
        'pelanggan_id',
        'nopol',
        'jenis_sewa',
        'jadwal_kembali',
        'tanggal_kembali',
        'durasi',
         'tgl_sewa',  
        'harga_sewa',
        'opsi_pengantaran',
        'sub_total',
        'denda',
        'harga_total',
        'status',
        'biaya_supir',
        'biaya_antar',
        'lokasi_jemput',
        'lokasi_kembali',
        'dp',
        'sisa_tagihan'
    ];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'nopol', 'nopol');
    }
}
