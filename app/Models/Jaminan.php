<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    protected $table = 'tr_jaminan';
    protected $primaryKey = 'id_jaminan';
    protected $fillable = [
        'id_tr_sewa',
        'ktp',
        'kk',
        'simA', 
        'rumah',
        'rekening',
        'motor',
        'rekening_listrik',
        'foto_wajah',
        ];

        public function sewa()
        {
            return $this->belongsTo(Sewa::class, 'id_tr_sewa', 'id_tr_sewa');
        }

}