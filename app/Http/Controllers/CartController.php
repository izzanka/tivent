<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use App\Event;
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
        $transaksi = Transaksi::where('user_id',Auth::user()->id)->where('kode_tiket',null)->latest()->get();
     
        return view('cart.index',compact('transaksi'));
    }

   
}
