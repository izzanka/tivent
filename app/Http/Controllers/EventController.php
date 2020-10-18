<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Event;
use App\Tiket;
use App\Transaksi;
use App\User;
use Auth;

class EventController extends Controller
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
        $event = Event::where('user_id',Auth::user()->id)->get();
        return view('event.index',compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check = Auth::user()->id;
        $user = User::where('id',$check)->first();
        if($user->nomor_rekening == null){
            return view('profile.index',compact('user'));
        }else{
            return view('event.create');
        }
        
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
            'nama_event' => 'required',
            'deskripsi_event' => 'required',
            'kategori_event' => 'required',
            'tempat_event' => 'required',
            'waktu_event' => 'required',
            'tanggal_event' => 'required',
            'foto_event' => 'required|image',
            'foto_identitas' => 'required|image',
        ]);

        $check = Auth::user()->id;
        $user = User::where('id',$check)->first();

        if($user->nomor_rekening == null){
            return view('profile.index',compact('user'));
        }else{
            $event = new Event;
            $event->user_id = $user->id;
            $event->nama_event = $request->nama_event;
            $event->deskripsi_event = $request->deskripsi_event;
            $event->kategori_event = $request->kategori_event;
            $event->tempat_event = $request->tempat_event;
            $event->waktu_event = $request->waktu_event;
            $event->tanggal_event = $request->tanggal_event;
            $event->status_event = 0;
            if($request->hasFile('foto_event')){
                $uuid = Str::uuid()->toString();
                $file = $uuid . '-' . $request->file('foto_event')->getClientOriginalName();
                $path = $request->file('foto_event')->storeAs('public/event',$file);
                $event->foto_event = $file;
            }
            if($request->hasFile('foto_identitas')){
                $uuid = Str::uuid()->toString();
                $file = $uuid . '-' . $request->file('foto_identitas')->getClientOriginalName();
                $path = $request->file('foto_identitas')->storeAs('public/identitas',$file);
                $event->foto_identitas = $file;
            }
            $event->save();

            return redirect('/event');
        }

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
        $event = Event::where('id',$id)->where('status_event',0)->first();
        return view('event.edit', compact('event'));
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
            'nama_event' => 'required',
            'deskripsi_event' => 'required',
            'kategori_event' => 'required',
            'tempat_event' => 'required',
            'waktu_event' => 'required',
            'tanggal_event' => 'required',
        ]);

        $event = Event::where('id',$id)->first();
        $event->nama_event = $request->nama_event;
        $event->deskripsi_event = $request->deskripsi_event;
        $event->kategori_event = $request->kategori_event;  
        $event->tempat_event = $request->tempat_event;
        $event->waktu_event = $request->waktu_event;
        $event->tanggal_event = $request->tanggal_event;
        if($request->hasFile('foto_event')){
            $uuid = Str::uuid()->toString();
            $file = $uuid . '-' . $request->file('foto_event')->getClientOriginalName();
            $path = $request->file('foto_event')->storeAs('public/event',$file);
            $event->foto_event = $file;
        }
        if($request->hasFile('foto_identitas')){
            $uuid = Str::uuid()->toString();
            $file = $uuid . '-' . $request->file('foto_identitas')->getClientOriginalName();
            $path = $request->file('foto_identitas')->storeAs('public/identitas',$file);
            $event->foto_identitas = $file;
        }
        $event->update();

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
        $event = Event::where('id',$id)->first();
        $tiket = Tiket::where('event_id',$id)->get();
        foreach($tiket as $tikets){
            $transaksi = Transaksi::where('tiket_id',$tikets->id)->get();
        }

        if(Storage::exists('public/event/'.$event->foto_event) && Storage::exists('public/identitas/'.$event->foto_identitas)){
            Storage::delete(['public/event/'.$event->foto_event, 'public/identitas/' . $event->foto_identitas]);            
        }
        $transaksi->each->delete();
        $tiket->each->delete();
        $event->delete();
       
        return redirect('/event');
    }

    public function mulai($id){
        $event = Event::where('id',$id)->first();
        $tiket = Tiket::where('event_id',$id)->first();
        $transaksi = Transaksi::where('tiket_id',$tiket->id)->get();
        

        $event->status_event = 1;
        foreach($transaksi as $t){
            $t->status = 7;
        }
        $event->update();
        $t->update();

        return redirect('/event');
    }

    public function selesai($id){
        $event = Event::where('id',$id)->first();
        $tiket = Tiket::where('event_id',$id)->get();
        foreach($tiket as $t){
            $transaksi = Transaksi::where('tiket_id',$t->id)->get();
        }
       

        $event->status_event = 2;
        foreach($transaksi as $t){
            $t->status = 8;
        }
        $event->update();
        $t->update();

        return redirect('/event');
    }
}
