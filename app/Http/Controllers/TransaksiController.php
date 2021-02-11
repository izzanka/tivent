<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
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
            'jumlah_tiket' => 'required|min:1|numeric|max:35',
        ]);
        
        $tiket = Tiket::where('id',$id)->firstOrFail();

        if($request->jumlah_tiket > $tiket->jumlah_tiket){
            Session::flash('error', "Jumlah Tiket Melebihi Stock!");
            return redirect()->back();
        }elseif($tiket->event->status_event == 1 && 2){
            Session::flash('error', "Event Sudah Dimulai / Selesai!");
            return redirect()->back();
        }
        else{
            $transaksi = new Transaksi;
            $transaksi->user_id = Auth::user()->id;
            $transaksi->tiket_id = $tiket->id;
            $transaksi->jumlah_tiket = $request->jumlah_tiket;
            $transaksi->kode_tiket = null;
            $transaksi->total_harga = $request->jumlah_tiket * $tiket->harga_tiket;
            $transaksi->bukti_pembayaran = null;
            if($tiket->harga_tiket == 0){
                $transaksi->status = 1;
            }else{
                $transaksi->status = 0;
            }
            $transaksi->save();

            $tiket->jumlah_tiket = $tiket->jumlah_tiket - $request->jumlah_tiket;
            $tiket->update();

            return redirect('/cart')->with('success','Pemesanan Berhasil!');
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
        $tiket = Tiket::where('id',$id)->firstOrFail();
        $transaksi = Transaksi::where('tiket_id',$id)->firstOrFail();

        $kode = $transaksi->kode_tiket;
        $kode_tiket = explode(",",$kode);
        foreach ($kode_tiket as $k) {
            if(Storage::exists('public/qrcodes/'. $k .'.svg')){
                Storage::delete(['public/qrcodes/'. $k .'.svg']);            
            }
        }

        $tiket->jumlah_tiket += $transaksi->jumlah_tiket;
        $tiket->update();
        $transaksi->status = 4;
        $transaksi->update();

        return redirect('/history')->with('success','Pemesanan Berhasil Dibatalkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createbukti($id)
    {
       
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
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $transaksi = Transaksi::where('id',$id)->firstOrFail();
        if($request->hasFile('bukti_pembayaran')){
            $file = time() . '-' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $path = $request->file('bukti_pembayaran')->storeAs('public/bukti',$file);
            $transaksi->bukti_pembayaran = $file;
        }
        $transaksi->status = 1;
        $transaksi->update();

        return redirect('/cart')->with('success','Bukti Pembayaran Berhasil Diupload!');
     
    }

    public function delete($id){
        $transaksi = Transaksi::where('id',$id)->firstOrFail();
        $kode = $transaksi->kode_tiket;
        $kode_tiket = explode(",",$kode);
        foreach ($kode_tiket as $k) {
            if(Storage::exists('public/qrcodes/'. $k .'.svg')){
                Storage::delete(['public/qrcodes/'. $k .'.svg']);            
            }
        }
        $transaksi->delete();
        return redirect('/cart')->with('success','Pemesanan Berhasil Dihapus!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
}
