<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;
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
