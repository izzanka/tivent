<?php

namespace App\View\Components;

use App\Models\Event;
use Illuminate\View\Component;

class UserEvent extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $events = Event::where('user_id',auth()->id())->count();
        return view('components.user-event',compact('events'));

    }
}
