@extends('layouts.app')
@section('title')
    Order Ticket
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('event.detail',$ticket->event_id) }}" class="text-dark">{{ $ticket->event->name }}</a></li>
                    <li class="breadcrumb-item" aria-current="page">Ticket</li>
                    <li class="breadcrumb-item" aria-current="page">{{ $ticket->type }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
            </nav>
        </div>

        @if (session()->has('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show" role="alert">
                <strong>{!! session()->get('message')['text'] !!}</strong>
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
                    $images = json_decode($ticket->event->images);
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
                                <td>Name event</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control " value="{{ $ticket->event->name }}" disabled>

                                </td>
                            </tr>
                            <tr>
                                <td>Ticket type</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control " value="{{ $ticket->type }}" disabled>

                                </td>
                            </tr>
                            <tr>
                                <td>Ticket Price</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control " value="Rp. {{ number_format($ticket->price) }}" disabled>

                                </td>
                            </tr>
                            <tr>
                                <td>Ticket available</td>
                                <td>:</td>
                                <td>
                                    <input
                                        class="form-control " value="{{ $ticket->amount }}" disabled>

                                </td>
                            </tr>
                            <form action="{{ route('order.store',$ticket->id) }}" method="POST">
                                @csrf
                                <tr>
                                    <td>Number of tickets, you want order</td>
                                    <td>:</td>
                                    <td>
                                        <input
                                            class="form-control @error('ticket_amount') is-invalid @enderror" name="ticket_amount" min="1">
                                        @error('ticket_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                    

                                <tr>    
                                    <td colspan="3">
                                        <button class="btn btn-dark btn-block" type="submit">Order Ticket</button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                
                    </div>
                </div>
                        
            </div>
        </div>
    
    </div>
    
</div>

@endsection