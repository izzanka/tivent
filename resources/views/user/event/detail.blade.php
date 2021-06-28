@extends('layouts.app')
@section('title')
    Detail Event
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $event->name }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
    </div>

        <div class="row">
            <div class="col-md-6">
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
                <hr>
            
            </div>
          
            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <table class="table" style="border-top : hidden">
                            <tr>
                                <td>Name Event</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control " value="{{ $event->name }}" disabled>

                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td>
                                    <textarea cols="15" rows="5" class="form-control" disabled>{{ $event->description }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control " value="{{ $event->category }}" disabled>
                                </td>
                            </tr>

                                    
                            <tr>
                                <td>Location</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control" value="{{ $event->location}}" disabled>
         
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td>
                                    <input type="text"
                                        class="form-control" value="{{ $event->date }}" disabled>

                                </td>
                            </tr>

                            <tr>
                                <td>Time</td>
                                <td>:</td>
                                <td>
                                    <input type="text"
                                        class="form-control " value="{{ $event->getTime() }}" disabled>

                                </td>
                            </tr>

                            <tr>
                                <td>Ticket</td>
                                <td>:</td>
                                <td>

                                    @if ($event->status == 1)
                                        <p class="text-success">Event has started</p>
                                    @elseif($event->status == 2)
                                        <p class="text-danger">Event has finished</p>
                                    @else
                                        @forelse ($tickets as $ticket)
                                            <a href="{{ route('order.index',$ticket->id) }}" class="btn btn-primary btn-sm btn-block">{{ $ticket->type }}</a>
                                        @empty
                                            No Ticket
                                        @endforelse
                                    @endif
                                   
                                </td>
                            </tr>

                        </table>
                
                    </div>
                </div>
                        
            </div>
        </div>
    
    </div>
    
</div>

@endsection