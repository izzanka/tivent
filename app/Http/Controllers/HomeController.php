<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Tiket;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $event = Event::latest()->paginate(4);
        $tiket = Tiket::all();
        return view('home',compact('event','tiket'));
    }

    public function detail($id)
    {
        $tiket = Tiket::where('event_id',$id)->get();
        $event = Event::where('id',$id)->firstOrFail();
        return view('detail',compact('tiket','event'));
    }

    public function search(Request $request)
    {
        $tiket = Tiket::all();
        $event = Event::latest()->where('nama_event','LIKE','%'.$request->search.'%')->paginate(4);
        return view('home',compact('event','tiket'));
    }

    public function kategori($kategori){
        $event = Event::latest()->where('kategori_event',$kategori)->paginate(4);
        $tiket = Tiket::all();
        return view('home',compact('event','tiket'));
    }
}
