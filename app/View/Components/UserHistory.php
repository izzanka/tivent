<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\View\Component;

class UserHistory extends Component
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
        $orders = Order::where('user_id',auth()->id())->whereIn('status',[2,3,4])->get();
        if(!empty($orders)){
            foreach($orders as $order){
                $historys = OrderDetail::where('order_id',$order->id)->count();
            }
            if(!empty($historys)){
                return view('components.user-history',compact('historys'));
            }
        }
        return view('components.user-history');
    }
}
