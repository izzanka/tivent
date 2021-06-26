<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
