<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nama_event', 'deskripsi_event', 'kategori_event', 'tempat_event','waktu_event', 'tanggal_event', 'foto_event', 'foto_identitas',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function tiket(){
        return $this->hasMany('App\Tiket','event_id','id');
    }

    
}
