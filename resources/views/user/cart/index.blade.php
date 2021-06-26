@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
        <div class="col">
            <div class="table-responsive">
                @if (!empty($orderdetails))
                    <a href="{{ route('home') }}"><i class="bi bi-plus"></i> Order More</a>
                @endif
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Ticket Type</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($orderdetails))
                        @foreach ($orderdetails as $orderdetail)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td><a href="{{ route('event.detail',$orderdetail->ticket->event->id) }}">{{ $orderdetail->ticket->event->name }}</a></td>
                            <td>{{ $orderdetail->ticket->type}}</td>
                            <td>{{ $orderdetail->ticket_amount }}</td>
                            <td>Rp. {{ number_format($orderdetail->ticket->price) }}</td>
                            <td>Rp. {{ number_format($orderdetail->total_price) }}</td>
                            <td>
                                <a href="{{ route('cart.cancel',[$orderdetail->order->id,$orderdetail->id]) }}" class="btn btn-sm btn-warning" onClick="return confirm('Are you sure?')">Cancel</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <td colspan="7"><strong>Cart Empty </strong> </td>
                    @endif
                        
                            @if (!empty($order))
                                 
                                {{ $orderdetails->links() }}
                                
                                <tr>
                                    <td colspan="5" align="left"><strong>Total Price : </strong></td>
                                    <td align="right"><strong>Rp. {{ number_format($order->total_price) }}</strong> </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6"></td>
                                    <td colspan="2">
                                        <a href="{{ route('cart.checkout',$order->id) }}" class="btn btn-success">
                                            <i class="bi bi-arrow-right-circle"></i>-> Check Out
                                        </a>
                                    </td>
                                </tr>
                            @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    
</div>

@endsection