<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

use App\Tiket;
use App\Event;
use App\Transaksi;
use App\User;

class ProfileController extends Controller
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
        $user = User::where('id',Auth::user()->id)->first();
        return view('profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|max:255|email',
            'nomor_rekening' => 'max:15',
            'password' => 'string|min:4|confirmed',
        ]);

        $user = User::where('id',Auth::user()->id)->first();
        if(!empty($request->password)){
            $user->name = $user->name;
            $user->email = $user->email;
            $user->nomor_rekening = $user->nomor_rekening;
            $user->password = Hash::make($request['password']);
            $user->update();
            return redirect('/profile');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_rekening = $request->nomor_rekening;
        $user->update();
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        $transaksi = Transaksi::where('user_id',$user->id)->get();
        $event = Event::where('user_id',$user->id)->get();

        foreach($event as $events){
            $tiket = Tiket::where('event_id',$events->id)->get();
            if(Storage::exists('public/event/'.$events->foto_event) && Storage::exists('public/identitas/'.$events->foto_identitas)){
                Storage::delete(['public/event/'.$events->foto_event, 'public/identitas/' . $events->foto_identitas]);            
            }
            $tiket->each->delete();
        }
        foreach($transaksi as $transaksis){
            if(Storage::exists('public/bukti/'.$transaksis->bukti_pembayaran)){
                Storage::delete(['public/bukti/'.$transaksis->bukti_pembayaran]);            
            }
            $transaksi->each->forceDelete();
        }
        
        $event->each->delete();
        $user->forceDelete();
     

        return redirect('/login');
    }
}
