<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tiket extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'jenis_tiket','harga_tiket','jumlah_tiket',
    ];

    public function event(){
        return $this->belongsTo('App\Event','event_id','id');
    }

    public function transaksi(){
        return $this->hasMany('App\Transaksi','tiket_id','id');
    }

}
