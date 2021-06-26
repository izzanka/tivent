<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketCartController extends Controller
{
    public function index(Order $order)
    {
        $orderdetails = OrderDetail::with('order','ticket')->where('order_id',$order->id)->where('ticket_code','!=',null)->latest()->paginate(1);
        return view('user.ticket.cart',compact('orderdetails'));
    }

}
