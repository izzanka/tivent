<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tiket;
use App\Event;

class TiketController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $event = Event::where('id',$id)->firstOrFail();
        return view('tiket.create',compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_tiket' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'harga_tiket' => 'required|numeric',
            'jumlah_tiket' => 'required|numeric',
        ]);
        
        $id = $request->id_event;
        $event = Event::where('id',$id)->firstOrFail();

        $tiket = new Tiket;
        $tiket->event_id = $event->id;
        $tiket->jenis_tiket = $request->jenis_tiket;
        $pajak = $request->harga_tiket * 0.05;
        $total_harga = $request->harga_tiket + $pajak;
        $tiket->harga_tiket = $total_harga;
        $tiket->jumlah_tiket = $request->jumlah_tiket;
        $tiket->save();

        return redirect('/event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $tiket = Tiket::where('event_id',$id)->paginate(8);
       $event = Event::where('id',$id)->firstOrFail();
       return view('tiket.index',compact('tiket','event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiket = Tiket::where('id',$id)->firstOrFail();
        return view('tiket.edit',compact('tiket'));
        
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
        $request->validate([
            'jenis_tiket' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'harga_tiket' => 'required|numeric',
            'jumlah_tiket' => 'required|numeric',
        ]);
        
        $tiket = Tiket::where('id',$id)->firstOrFail();
        $tiket->jenis_tiket = $request->jenis_tiket;
        $pajak = $request->harga_tiket * 0.05;
        $total_harga = $request->harga_tiket + $pajak;
        $tiket->harga_tiket = $total_harga;
        $tiket->jumlah_tiket = $request->jumlah_tiket;
        $tiket->update();

        return redirect('/event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Tiket::where('id',$id)->firstOrFail();
        $tiket->delete();
        return redirect()->back();
    }
}
