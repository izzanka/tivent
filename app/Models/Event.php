<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'location',
        'time',
        'date',
        'images',
    ];

    public function getTime($time){
        return Carbon::createFromFormat('H:i:s', $time)->format('H:i');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
