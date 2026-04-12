<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
     protected $table = 'kendaraan';

    protected $primaryKey = 'nopol';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nopol',
        'category_id',
        'cabang_id',
        'nama_kendaraan',
        'transmisi',
        'harga',
        'deskripsi',
        'warna',
        'kondisi',
        'bbm',
        'tahun',
        'dir',
        'denda_terlambat',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function cabang(){
        return $this->belongsTo(Cabang::class,'cabang_id');
    }

}
