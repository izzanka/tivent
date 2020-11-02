<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use App\Transaksi;
use App\User;

class NotifTiket extends Component
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
        $notiftiket = Transaksi::where('status',2)->where('user_id',Auth::user()->id)->get();
        return view('components.notif-tiket',compact('notiftiket'));
    }
}
