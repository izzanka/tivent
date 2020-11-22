<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Event;
use App\Transaksi;
use App\Tiket;

class EventController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::withTrashed()->latest()->paginate(4);
        $tiket = Tiket::all();
        return view('admin.allevent',compact('event','tiket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checktiket($kode)
    {
        $transaksi = Transaksi::all();
        $check =  $transaksi->contains('kode_tiket',$kode);
        if($check){
            return redirect('/checktiket')->with('success','Kode Tiket Ditemukkan');
        }else{
            return redirect('/checktiket')->with('error','Kode Tiket Tidak Ditemukkan');
        }
      
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tiket()
    {
        return view('admin.checktiket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::withTrashed()->where('id',$id)->first();
        $event->forceDelete();
        return redirect()->back();
    }
}
