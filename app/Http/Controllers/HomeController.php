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
        $event = Event::all();
        $tiket = Tiket::all();
        return view('home',compact('event','tiket'));
    }

    public function detail($id)
    {
        $tiket = Tiket::where('event_id',$id)->get();
        $event = Event::where('id',$id)->first();
        return view('detail',compact('tiket','event'));
    }
}
