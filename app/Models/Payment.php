<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'sewa_id',
        'payment_type',
        'transaction_status',
        'jumlah_bayar',
        'order_id',
        'snap_token',
        'status_pembayaran',
        'dp',
        'sisa_bayar'
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }
}
