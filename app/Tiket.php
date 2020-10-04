<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    public function event(){
        return $this->belongsTo('App\Event','event_id','id');
    }

    public function transaksi(){
        return $this->hasMany('App\Transaksi','tiket_id','id');
    }

}
