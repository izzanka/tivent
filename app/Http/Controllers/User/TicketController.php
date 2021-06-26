<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function __construct(){
        $this->middleware('can:edit-event,event')->only(['index','create','store']);
        $this->middleware('can:edit-ticket,ticket')->only(['edit','update','delete']);
    }
    
    public function index(Event $event)
    {
        $tickets = Ticket::with('event')->where('event_id',$event->id)->get();
        
        return view('user.ticket.index',compact('tickets','event'));
    }

    public function create(Event $event)
    {
        return view('user.ticket.create',compact('event'));
    }

    public function store(Request $request,Event $event)
    {
        $request->validate([
            'type' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        Ticket::create([
            'event_id' => $event->id,
            'type' => $request->type,
            'price' => $request->price,
            'amount' => $request->amount
        ]);

        return redirect()->route('ticket.index',['event' => $event->id])->with('message',['text' => 'Ticket successfully created!', 'class' => 'success']);;
    }

    public function show()
    {
    
    }

    public function edit(Ticket $ticket,Event $event)
    {
        return view('user.ticket.edit',compact('ticket','event'));
    }

    public function update(Request $request,Ticket $ticket)
    {
        $request->validate([
            'type' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        $ticket->update([
            'type' => $request->type,
            'price' => $request->price,
            'amount' => $request->amount
        ]);

        return redirect()->route('ticket.index',['event' => $ticket->event->id])->with('message',['text' => 'Ticket successfully updated!', 'class' => 'success']);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('ticket.index',['event' => $ticket->event->id])->with('message',['text' => 'Ticket successfully deleted!', 'class' => 'success']);
    }
}
