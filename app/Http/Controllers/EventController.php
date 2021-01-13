<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Session;
use App\Event;
use App\Tiket;
use App\Transaksi;
use App\User;
use Auth;
use Carbon\Carbon;

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
        $event = Event::latest()->where('user_id',Auth::user()->id)->paginate(4);
        return view('event.index',compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('id',Auth::user()->id)->firstOrFail();
        if($user->nomor_rekening == null){
            return view('profile.index',compact('user'))->with('error','Nomor Rekening Kosong!');
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
            'nama_event' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'deskripsi_event' => 'required|string',
            'kategori_event' => 'required',
            'tempat_event' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'waktu_event' => 'required',
            'tanggal_event' => 'required',
            'foto_event' => 'required|image|max:2048',
            'foto_identitas' => 'required|image|max:2048',
        ]);

        $check = Auth::user()->id;
        $checktanggal = Carbon::today();

        $user = User::where('id',$check)->firstOrFail();

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
            if($request->tanggal_event <= $checktanggal){
                Session::flash('error', "Tanggal Invalid!");
                return redirect()->back();
            }else{
                $event->tanggal_event = $request->tanggal_event;
            }
            $event->status_event = 0;
            if($request->hasFile('foto_event')){
                $file = time() . '-' . $request->file('foto_event')->getClientOriginalName();
                $path = $request->file('foto_event')->storeAs('public/event',$file);
                $event->foto_event = $file;
            }
            if($request->hasFile('foto_identitas')){
                $file = time() . '-' . $request->file('foto_identitas')->getClientOriginalName();
                $path = $request->file('foto_identitas')->storeAs('public/identitas',$file);
                $event->foto_identitas = $file;
            }
            $event->save();

            return redirect('/event')->with('success','Event Berhasil Ditambahkan!');
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
        $event = Event::where('id',$id)->where('status_event',0)->firstOrFail();
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
            'nama_event' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'deskripsi_event' => 'required|string',
            'kategori_event' => 'required',
            'tempat_event' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'waktu_event' => 'required',
            'tanggal_event' => 'required',
            'foto_event' => 'image|max:2048',
            'foto_identitas' => 'image|max:2048',
        ]);
        $checktanggal = Carbon::today();
        $event = Event::where('id',$id)->firstOrFail();
        $event->nama_event = $request->nama_event;
        $event->deskripsi_event = $request->deskripsi_event;
        $event->kategori_event = $request->kategori_event;  
        $event->tempat_event = $request->tempat_event;
        $event->waktu_event = $request->waktu_event;
        if($request->tanggal_event <= $checktanggal){
            Session::flash('error', "Tanggal Invalid!");
            return redirect()->back();
        }else{
            $event->tanggal_event = $request->tanggal_event;
        }
        if($request->hasFile('foto_event')){
            $file = time() . '-' . $request->file('foto_event')->getClientOriginalName();
            $path = $request->file('foto_event')->storeAs('public/event',$file);
            $event->foto_event = $file;
        }
        if($request->hasFile('foto_identitas')){
            $file = time() . '-' . $request->file('foto_identitas')->getClientOriginalName();
            $path = $request->file('foto_identitas')->storeAs('public/identitas',$file);
            $event->foto_identitas = $file;
        }
        $event->update();

        return redirect('/event')->with('success','Event Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('id',$id)->firstOrFail();
        $tiket = Tiket::where('event_id',$id)->get();

        if(Storage::exists('public/event/'.$event->foto_event) && Storage::exists('public/identitas/'.$event->foto_identitas)){
            Storage::delete(['public/event/'.$event->foto_event, 'public/identitas/' . $event->foto_identitas]);            
        }
        $tiket->each->delete();
        $event->delete();
        Session::flash('success', "Event Berhasil Dihapus!");
        return redirect()->back();
    }

    public function mulai($id){
        $event = Event::where('id',$id)->firstOrFail();
        $event->status_event = 1;
        $event->update();
        return redirect('/event')->with('info','Event Dimulai!');
    }

    public function selesai($id){
        $event = Event::where('id',$id)->firstOrFail();
        $event->status_event = 2;
        $event->update();
        return redirect('/event')->with('info','Event Selesai!');
    }
}
