<?php

namespace App\Http\Controllers\User;

use PDF;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function index(OrderDetail $orderdetail)
    {
        $orderdetails = OrderDetail::where('id',$orderdetail->id)->with('ticket')->get();
        $pdf = PDF::loadview('user.pdf.index',compact('orderdetails'));
        return $pdf->stream('Tivent-ticket.pdf');
    }
}
