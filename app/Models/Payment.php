<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tr_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        'order_id',
        'id_tr_sewa',
        'payment_type',
        'transaction_status',
        'jumlah_bayar',
        'total_bayar',
        'keterangan',
        'status_pembayaran'
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'id_tr_sewa', 'id_tr_sewa');
    }
}
