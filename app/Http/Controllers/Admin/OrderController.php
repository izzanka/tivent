<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('user')->where('status',2)->latest()->paginate(5);
        return view('admin.order.index',compact('orders'));
    }

    public function confirm(Order $order,$status){
     
        $orderdetails = OrderDetail::where('order_id',$order->id)->with('ticket')->get();
        if($status == "success"){
            foreach($orderdetails as $orderdetail){

                $array_number = [];
    
                for ($i=0; $i < $orderdetail->ticket_amount; $i++) { 
                    $random_number = rand(10000,99999);
                    $array_number[] = $random_number;
                }
    
                $ticket_code = json_encode($array_number);
                $orderdetail->ticket_code = $ticket_code;
                $orderdetail->update();
    
                $array_ticket_code = [];
                $array_ticket_code = json_decode($orderdetail->ticket_code);
    
                for ($j=0; $j < $orderdetail->ticket_amount; $j++) {
                    QrCode::size(100)->generate(
                        $array_ticket_code[$j], '../public/qrcodes/' . $array_ticket_code[$j] . '.svg'
                    );
                }
            }
            $order->status = 3;
            $order->update();
    
            return back()->with('message',['text' => 'Order successfully confirmed!', 'class' => 'success']);

        }else if($status == "failed"){

            $order->status = 4;
            $order->update();
    
            return back()->with('message',['text' => 'Order failed to confirm!', 'class' => 'danger']);
        }
       
    }

    public function history(){
        $orders = Order::with('user')->whereNotIn('status',[0,1,2])->latest()->paginate(5);
        return view('admin.order.history',compact('orders'));
    }
}
