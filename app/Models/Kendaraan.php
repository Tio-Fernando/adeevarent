<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
     protected $table = 'ms_kendaraan';

    protected $primaryKey = 'nopol';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nopol',
        'id_kategori',
        'id_cabang',
        'nama_kendaraan',
        'transmisi',
        'harga',
        'deskripsi',
        'warna',
        'jumlah_kursi',
        'kondisi',
        'bbm',
        'tahun',
        'dir',
        'denda_terlambat',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'id_kategori');
    }

    public function cabang(){
        return $this->belongsTo(Cabang::class,'id_cabang');
    }

}
