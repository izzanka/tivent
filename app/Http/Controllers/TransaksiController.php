<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\Tiket;
use App\Event;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tiket = Tiket::where('id',$id)->firstOrFail();
        return view('transaksi.create',compact('tiket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
       
        $request->validate([
            'jumlah_tiket' => 'required|min:1',
        ]);
        
        $tiket = Tiket::where('id',$id)->first();

        if($request->jumlah_tiket > $tiket->jumlah_tiket){
            return redirect()->back();
        }elseif($tiket->event->status_event == 1 && 2)
            return redirect()->back();
        else{
            $transaksi = new Transaksi;
            $transaksi->user_id = Auth::user()->id;
            $transaksi->tiket_id = $tiket->id;
            $transaksi->jumlah_tiket = $request->jumlah_tiket;
            $transaksi->kode_tiket = null;
            $transaksi->total_harga = $request->jumlah_tiket * $tiket->harga_tiket;
            $transaksi->bukti_pembayaran = null;
            $transaksi->status = 0;
            $transaksi->save();

            $tiket->jumlah_tiket = $tiket->jumlah_tiket - $request->jumlah_tiket;
            $tiket->update();

            return redirect('/cart');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $tiket = Tiket::where('id',$id)->first();
        $transaksi = Transaksi::where('tiket_id',$id)->first();

        $tiket->jumlah_tiket += $transaksi->jumlah_tiket;
        $tiket->update();
        
        $transaksi->delete();

        return redirect('/cart');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createbukti($id)
    {
        $transaksi = Transaksi::where('id',$id)->where('status',0)->first();
        $rek = User::where('role','admin')->first();
        return view('transaksi.createbukti',compact('transaksi','rek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storebukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image',
        ]);

        $transaksi = Transaksi::where('id',$id)->first();
        if($request->hasFile('bukti_pembayaran')){
            $uuid = Str::uuid()->toString();
            $file = $uuid. '-' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $path = $request->file('bukti_pembayaran')->storeAs('public/bukti',$file);
            $transaksi->bukti_pembayaran = $file;
        }
        $transaksi->status = 1;
        $transaksi->update();

        return redirect('/cart');
     
    }

    public function delete($id){
        $transaksi = Transaksi::where('id',$id)->first();
        $transaksi->delete();
        return redirect('/cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
}
