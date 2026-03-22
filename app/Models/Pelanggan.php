<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['id_user','nama_pelanggan','alamat'];

    public function user(){
        return $this->hasOne(User::class);
    }
}
