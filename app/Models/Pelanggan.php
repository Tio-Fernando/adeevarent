<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $primaryKey = 'id_pelanggan';
    protected $table = 'ms_pelanggan';
    protected $fillable = ['id_user','nama_pelanggan','no_hp','alamat'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
