<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\View\Component;

class UserCart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $orders = Order::where('user_id',auth()->id())->where('status',0)->get();
        if(!empty($orders)){
            foreach($orders as $order){
                $orderdetails = OrderDetail::where('order_id',$order->id)->count();
            }
            if(!empty($orderdetails)){
                return view('components.user-cart',compact('orderdetails'));
            }
        }
        return view('components.user-cart');
    }
}
