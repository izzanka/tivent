@extends('layouts.app')
@section('title')
    Ticket Cart
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ticket Cart</li>
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

    @forelse ($orderdetails as $orderdetail)
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header">
                {{ $orderdetail->ticket->event->name }}
                <a href="{{ route('cart.ticket.print',$orderdetail->id) }}" class="btn btn-sm btn-success float-right">Print Ticket</a>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $ticket_code = json_decode($orderdetail->ticket_code);
                        $n = 1;
                    @endphp
                    @for ($i = 0; $i < $orderdetail->ticket_amount; $i++)
                        <div class="col-sm-4 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <small class="float-right">{{ $n++ }}</small>
                                    <p class="card-text">
                                        {{ $orderdetail->ticket->type }} | {{ $ticket_code[$i] }}<br>
                                        <hr>
                                        {{ $orderdetail->ticket->event->location }}<br>
                                        {{ $orderdetail->ticket->event->date }} | {{ $orderdetail->ticket->event->getTime($orderdetail->ticket->event->time) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    @endfor
                </div>
            </div>
        </div>
        <div class="mt-4 float-right">
            {{ $orderdetails->links() }}
        </div>
    </div>
    @empty
        
    @endforelse
   

</div>
@endsection