@extends('layouts.app')
@section('title')
    Ticket
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Event</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ $event->name }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Ticket</li>
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
            <a href="{{ route('ticket.create',$event->id) }}" class="btn btn-primary float-right"> Create Ticket</a>
        </div>

        @forelse ($tickets as $ticket)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        {{ $ticket->event->name }}
                        <small class="float-right"><b>{{ $loop->iteration }}</b></small>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Type : {{ $ticket->type }}</li>
                        <li class="list-group-item">Price : Rp.{{ number_format($ticket->price) }}</li>
                        <li class="list-group-item">Amount : {{ $ticket->amount }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('ticket.edit',['event' => $event->id,'ticket' => $ticket->id]) }}" class="card-link">Edit</a>
                        <a href="{{ route('ticket.destroy',['event' => $event->id,'ticket' => $ticket->id]) }}" class="card-link text-danger">Delete</a>
                    </div>
                </div>
            </div>
        @empty
        <div class="col-md-12 mt-4">
            <h5 class="text-center">No Ticket</h5>
          </div>
        @endforelse

        
    </div>

    
</div>
@endsection