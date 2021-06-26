<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
       'order_id',
       'ticket_id',
       'ticket_amount',
       'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
