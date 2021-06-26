<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('can:edit-order,order')->only(['cart_checkout','checkout','cancel']);
 
    }

    public function index()
    {
        $order = Order::where('user_id',auth()->id())->whereIn('status',[0,1])->first();
        if($order){
            if($order->status == 1){
                return redirect(route('cart.checkout',$order->id))->with('message',['text' => 'Please finish this payment immediately before ordering!','class' => 'danger']);
            }
    
            if($order){
                $orderdetails = OrderDetail::where('order_id',$order->id)->with('order','ticket')->paginate(5);
                return view('user.cart.index',compact('orderdetails','order'));
            }

        }else{
            return view('user.cart.index');

        }

    }

    public function cart_checkout(Order $order)
    {
        $order->status = 1;
        $order->update();

        return view('user.cart.checkout',compact('order'));
    }

    public function checkout(Order $order){

        $order->status = 2;
        $order->update();

        $orderdetails = OrderDetail::where('order_id',$order->id)->get();

        foreach($orderdetails as $orderdetail){
            $ticket = Ticket::where('id',$orderdetail->ticket_id)->first();
            $ticket->amount -= $orderdetail->ticket_amount;
            $ticket->update();
        }

        return redirect('history')->with('message',['text' => 'Checkout successfully, please wait our admin to response','class' => 'success']);
    }

    public function cancel(Order $order,$id)
    {
        $orderdetail = OrderDetail::find($id);
        $total = OrderDetail::where('order_id',$order->id)->count();
        if($total == 1){
            $order->delete();
        }else{
            $order->total_price -= $orderdetail->total_price;
            $order->update();
        }
        $orderdetail->delete();
        return back()->with('message',['text' => 'Order was successfully deleted from cart!','class' => 'success']);;
    }
}
