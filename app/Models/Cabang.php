<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'ms_cabang';
    protected $primaryKey ='id_cabang';
    protected $fillable = ['nama_cabang','lokasi'];

    public function kendaraan(){
        return $this->hasMany(Kendaraan::class);
    }
}
