<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'jumlah_tiket', 'bukti_pembayaran',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function tiket(){
        return $this->belongsTo('App\Tiket','tiket_id','id');
    }
}
