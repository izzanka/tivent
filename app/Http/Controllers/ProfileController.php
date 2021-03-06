<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Auth;
use App\User;
use App\Transaksi;
use App\Event;
use App\Tiket;

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
        $user = User::where('id',Auth::user()->id)->first();
        
        if(Auth::user()->email == $request->email){
            $request->validate([
                'name' => 'string|max:255|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
                'nomor_rekening' => 'max:15|min:10',
                'password' => 'string|min:4|confirmed',
                'image' => 'image|max:2048',
            ]);
            if(!empty($request->password)){
                $user->password = Hash::make($request['password']);
                $user->update();
                return redirect('/profile')->with('success','Profile Berhasil Diupdate!');;
            }
            $user->name = $request->name;
            $user->nomor_rekening = $request->nomor_rekening;
            if($request->hasFile('image')){
                $file = time() . '-' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('public/foto_profile',$file);
                $user->image = $file;
            }
            $user->update();
            return redirect('/profile')->with('success','Profile Berhasil Diupdate!');
        }

        else{
            $request->validate([
                'name' => 'string|max:255|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
                'email' => 'string|max:255|email:rfc,strict,filter|unique:users',
                'nomor_rekening' => 'max:15|min:10',
                'password' => 'string|min:4|confirmed',
                'image' => 'image|max:2048',
            ]);

            if(!empty($request->password)){
                $user->password = Hash::make($request['password']);
                $user->update();
                return redirect('/profile')->with('success','Profile Berhasil Diupdate!');;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->nomor_rekening = $request->nomor_rekening;
            if($request->hasFile('image')){
                $file = time() . '-' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('public/foto_profile',$file);
                $user->image = $file;
            }
            $user->update();
            return redirect('/profile')->with('success','Profile Berhasil Diupdate!');
        }


    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->firstOrFail();
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
            $kode = $transaksis->kode_tiket;
            $kode_tiket = explode(",",$kode);

            foreach ($kode_tiket as $k) {
                if(Storage::exists('public/qrcodes/'. $k .'.svg')){
                    Storage::delete(['public/qrcodes/'. $k .'.svg']);            
                }
            }

            if(Storage::exists('public/bukti/'.$transaksis->bukti_pembayaran)){
                Storage::delete(['public/bukti/'.$transaksis->bukti_pembayaran]);            
            }

            $transaksi->each->delete();
        }

        $event->each->delete();
        $user->delete();
     

        return redirect('/home')->with('success','User Berhasil Dihapus');
    }
}
