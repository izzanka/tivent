<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Ticket;
use Spatie\Image\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function __construct(){
        $this->middleware('can:edit-event,event')->only(['edit','update','destroy','destroyImage','set_event']);
    }

    public function index()
    {
        $events = Event::with('user')->where('user_id',auth()->id())->get();
        return view('user.event.index',compact('events'));
    }

    public function create()
    {
        return view('user.event.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'description' => 'required',
            'category' => 'required',
            'location' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'time' => 'required',
            'date' => 'required|after:today',
            'images' => 'required',
            'images.*' => 'image|max:2048',
        ]);

        if($user->bank_account_number == null){
            return redirect(route('profile.index'))->with('message',['text' => 'Please fill the bank account number before creating an event!','class' => 'warning','status' => 'autofocus']);
        }else{

            $images = [];
        
            if($request->hasFile('images')){
                foreach($request->file('images') as $image){
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move('images/',$imageName);
                    Image::load(public_path('images') . '/' . $imageName)->width(400)->height(300)->save();
                    $images[] = $imageName;
                }
            }

            $image = json_encode($images);
            
            $user->events()->create([
                'images' => $image,
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'location' => $request->location,
                'time' => $request->time,
                'date' => $request->date,
            ]);
            
            return redirect('events')->with('message',['text' => 'Event successfully created!', 'class' => 'success']);
        }
    }

    public function detail(Event $event)
    {
        $tickets = Ticket::where('event_id',$event->id)->get();
        return view('user.event.detail',compact('event','tickets'));
    }

    public function edit(Event $event)
    {
        return view('user.event.edit',compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'description' => 'required',
            'category' => 'required',
            'location' => 'required|string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/',
            'time' => 'required',
            'date' => 'required',
            'images' => 'image|max:2048',
            'images.*' => 'image|max:2048',
        ]);

        $images = json_decode($event->images);
        
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move('images/',$imageName);
                Image::load(public_path('images') . '/' . $imageName)->width(400)->height(300)->save();
                $images[] = $imageName;
            }
        }

        $image = json_encode($images);
        
        $user->events()->update([
            'images' => $image,
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,
            'time' => $request->time,
            'date' => $request->date,
        ]);
        
        return redirect('events')->with('message',['text' => 'Event successfully updated!', 'class' => 'success']);
        
    }

    public function set_event(Event $event,$set){
        if($set == "start"){
            if($event->status == 1){
                return back()->with('message',['text' => 'Event has already started!', 'class' => 'warning']);
            }else{
                $event->status = 1;
                $event->update();
                return back()->with('message',['text' => 'Event started successfully!', 'class' => 'success']);
            }
        }else if($set == "finish"){
            if($event->status != 1){
                return back()->with('message',['text' => 'Event finished successfully!', 'class' => 'success']);
            }else{
                $event->status = 2;
                $event->update();
                return back()->with('message',['text' => 'Event has already started!', 'class' => 'warning']);
            }
        }
    }

    public function destroy(Event $event)
    {
        $images = json_decode($event->images);

        foreach($images as $image){
            File::delete('images/' . $image);
        }

        foreach($event->tickets as $ticket){
            $ticket->delete();
        }

        $event->delete();
        return redirect('events')->with('message',['text' => 'Event successfully deleted!', 'class' => 'success']);;
    }

    public function destroyImage($image,Event $event){
        
        $images = json_decode($event->images);
        if(in_array($image,$images)){
            $index = array_search($image,$images);
            unset($images[$index]);
            File::delete('images/' . $image);
            $updatedImage = json_encode($images);
            $event->update([
                'images' => $updatedImage
            ]);
        }
        return back()->with('message',['text' => 'Image successfully deleted!', 'class' => 'success']);;
    }
}
