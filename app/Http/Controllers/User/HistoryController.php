<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',auth()->id())->whereNotIn('status',[0,1])->latest()->paginate(5);
        return view('user.history.index',compact('orders'));
    }

}
