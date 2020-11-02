<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Transaksi;
use App\User;
use Auth;

class NotifOrder extends Component
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
        $notiforder = Transaksi::where('status',1)->get();
        return view('components.notif-order',compact('notiforder'));
    }
}
