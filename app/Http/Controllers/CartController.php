<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Auth;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::latest()->where('user_id',Auth::user()->id)->whereIn('status',[0,1,2,3])->paginate(6);
        return view('cart.index',compact('transaksi'));
    }

   
}
