<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Transaksi;
use App\User;
use Auth;

class NotifHistory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $notifhistory = Transaksi::latest()->where('user_id',Auth::user()->id)->where('status',4)->get();
        return view('components.notif-history',compact('notifhistory'));
    }
}
