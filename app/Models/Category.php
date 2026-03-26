<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['nama_kategori'];

    public function kendaraan(){
        return $this->hasMany(Kendaraan::class);
    }
}
