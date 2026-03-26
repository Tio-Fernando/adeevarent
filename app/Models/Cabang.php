<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';
    protected $fillable = ['lokasi'];

    public function kendaraan(){
        return $this->hasMany(Kendaraan::class);
    }
}
