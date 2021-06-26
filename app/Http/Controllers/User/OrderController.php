<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
   
    public function index(Ticket $ticket)
    {
        if($ticket->event->status == 1 ){
            return back()->with('message',['text' => 'Event has started', 'class' => 'warning']);
        }else if($ticket->event->status == 2){
            return back()->with('message',['text' => 'Event has finished', 'class' => 'warning']);
        }

        $ticket->with('event');
        return view('user.order.index',compact('ticket'));
    }

    public function store(Request $request,Ticket $ticket)
    {
        $user = auth()->user();
        $ticket->with('event');

        $check_empty_order = Order::where('user_id',$user->id)->whereNotIn('status',[1,2,3,4])->first();

        if($ticket->event->user_id == $user->id){
            return back()->with('message',['text' => 'You cant order your own ticket!', 'class' => 'danger']);
        }

        if($ticket->event->status == 1 ){
            return back()->with('message',['text' => 'Event has started', 'class' => 'warning']);
        }else if($ticket->event->status == 2){
            return back()->with('message',['text' => 'Event has finished', 'class' => 'warning']);
        }

        if(!empty($check_empty_order)){
            if($check_empty_order->status == 1){
                return redirect(route('cart.checkout',$check_empty_order->id))->with('message',['text' => 'Please finish this payment immediately before ordering!','class' => 'danger']);
            }
        }
      
        $request->validate([
            'ticket_amount' => 'required|numeric|min:1|max:' . $ticket->amount
        ]);

        $total_price = $request->ticket_amount * $ticket->price;

        if(empty($check_empty_order)){
            $user->orders()->create([
                'total_price' => $total_price,
                'status' => $ticket->price == 0 ? 1 : 0
            ]);
        }else{
            $check_empty_order->total_price += $total_price;
            $check_empty_order->update();
        }

        $order = Order::where('user_id',$user->id)->where('status',0)->first();

        $orderdetail = OrderDetail::create([
            'order_id' => $order->id,
            'ticket_id' => $ticket->id,
            'ticket_amount' => $request->ticket_amount,
            'total_price' => $total_price,
        ]);

        $msg = 'Ticket was successfully added to <a href="'. route('cart.index') . '">cart</a>';

        return back()->with('message',['text' => $msg, 'class' => 'success']);
    }
   
}
