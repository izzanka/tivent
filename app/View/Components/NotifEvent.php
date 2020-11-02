<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Event;
use App\User;
use Auth;

class NotifEvent extends Component
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
        $notifevent = Event::where('user_id',Auth::user()->id)->get();
        return view('components.notif-event',compact('notifevent'));
    }
}
