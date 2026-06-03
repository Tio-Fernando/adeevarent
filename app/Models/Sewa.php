<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jaminan;

class Sewa extends Model
{
    protected $table = 'tr_sewa';
    protected $primaryKey = 'id_tr_sewa';
    protected $appends = ['is_cash'];
    protected $fillable = [
        'id_pelanggan',
        'nopol',
        'jenis_sewa',
        'tanggal_sewa',
        'tanggal_kembali',
        'durasi',
        'jadwal_kembali',
        'harga_sewa',
        'opsi_pengantaran',
        'sub_total',
        'denda',
        'harga_total',
        'status',
        'biaya_supir',
        'lokasi_antar',
        'dp',
        'sisa_tagihan'
    ];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'nopol', 'nopol');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'id_tr_sewa', 'id_tr_sewa');
    }

    protected static function booted()
    {
        static::created(function ($sewa) {
            if (!$sewa->invoice) {
                $sewa->update([
                    'invoice' => now()->format('Ymd') . str_pad($sewa->id_tr_sewa, 3, '0', STR_PAD_LEFT)
                ]);
            }
        });
    }

    public function getisCashAttribute(){
        return $this->payments->where('payment_type','cash')->count() > 0;
    }

    public function jaminan(){
        return $this->hasOne(Jaminan::class, 'id_tr_sewa', 'id_tr_sewa');
     }

}
