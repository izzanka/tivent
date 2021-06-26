@extends('layouts.app')
@section('title')
    Event
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event</li>
                </ol>
            </nav>
        </div>

        @if (session()->has('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show" role="alert">
                <strong>{{ session('message')['text'] }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        <div class="col-sm-12">
            <a href="{{ route('events.create') }}" class="btn btn-primary float-right"> Create Event</a>
        </div>
    
        @forelse ($events as $event)
        <div class="col-md-6 mt-4">
          <div class="card">
            @php
              $images = json_decode($event->images);
              $imagei = implode($images);
              $result = preg_replace('/[^a-zA-Z]/', '', $imagei);
            @endphp
            <div id="{{ $result }}" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
              
                @foreach ($images as $image)
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('images/' . $image) }}" width="540px" height="300px">
                  </div>
                @endforeach
              </div>
              @if (count($images) > 1)
              <a class="carousel-control-prev" href="#{{ $result }}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#{{ $result }}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              @endif
             
            </div>
            <div class="card-body">
              <h5 class="card-title"><b>{{ $event->name }}</b></h5>
              <p class="card-text">{{ $event->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
              @if ($event->status == 1)
                  <li class="list-group-item text-success">Status : Event has started</li>
              @elseif($event->status == 2)
                  <li class="list-group-item text-danger">Status : Event has finished</li>
              @endif
              <li class="list-group-item">Location : {{ $event->location }}</li>
              <li class="list-group-item">Date     : {{ $event->date }}</li>
              <li class="list-group-item">Time     : {{ $event->time }}</li>
            </ul>
            <div class="card-body">
                <a href="" class="card-link">Detail</a>
                <a href="{{ route('events.edit',$event->id) }}" class="card-link">Edit</a>
                @if ($event->status == 1)
                  <a href="{{ route('event.set',[$event->id,"finish"]) }}" class="card-link float-right text-danger" onClick="return confirm('Are you sure?')">Finish</a>
                @elseif($event->status == null)
                <a href="{{ route('event.set',[$event->id,"start"]) }}" class="card-link float-right text-success" onClick="return confirm('Are you sure you want to start the event?\n-Tickets that related to the event cannot be edited!\n- Cannot order tickets for an event that has already started!')">Start</a>
                @endif
                <form action="{{ route('events.destroy',$event->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger mt-4 float-right">Delete</button>
                </form>
                <a href="{{ route('ticket.index',$event->id) }}" class="btn btn-sm btn-primary float-right mt-4 mr-2">Ticket</a>
            </div>
          </div>
        </div>
        @empty
          <div class="col-md-12 mt-4">
            <h5 class="text-center">No Event</h5>
          </div>
        @endforelse
    </div>

    
</div>
@endsection