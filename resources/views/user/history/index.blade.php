@extends('layouts.app')
@section('title')
    History
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
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

    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p>If order failed to confirm, please order again and make sure you transfer to the right account below!</p>
                    <div class="media mt-3">
                        <img class="mr-3" src="{{ asset('assets/payment/bca.png') }}" alt="Bank BRI" width="60">
                        <div class="media-body">
                            <h5 class="mt-0">BANK BCA</h5>
                            Account Number <strong>012345-678-910</strong> / <strong>Izzan Khairil Anam</strong>
                        </div>
                        <img class="mr-3" src="{{ asset('assets/payment/paypal.png') }}" alt="Bank BRI" width="60">
                        <div class="media-body">
                            <h5 class="mt-0">PAYPAL</h5>
                            Account Number <strong>012345-678-910</strong> / <strong>Izzan Khairil Anam</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th>Name Event</th>
                            <th>Type Ticket</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Total Order</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                           
                                @php
                                    $orderdetails = \App\Models\OrderDetail::with('ticket')->where('order_id',$order->id)->get();
                                    $total_amount = $orderdetails->sum('ticket_amount');
                                @endphp
                                <td>
                                    @foreach ($orderdetails as $orderdetail)
                                        {{ $orderdetail->ticket->event->name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($orderdetails as $orderdetail)
                                      {{ $orderdetail->ticket->type }}<br>
                                    @endforeach
                                </td>
                           
                                <td>
                                    @foreach ($orderdetails as $orderdetail)
                                    Rp. {{ number_format($orderdetail->ticket->price) }} x {{ $orderdetail->ticket_amount }}<br>
                                    @endforeach
                                </td>
                        
                                <td>Rp. {{ number_format($order->total_price) }}</td>
                                <td>{{ $total_amount }}</td>
                                <td>
                                    @if ($order->status == 2)
                                        Order is waiting for confirmation
                                    @elseif($order->status == 3)
                                        Order successfully confirmed<br>
                                        <a href="{{ route('cart.ticket.index',$order->id) }}">View Ticket</a>
                                    @elseif($order->status == 4)
                                        Order failed to confirm
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                        @empty
                        <td colspan="8"><strong>History Empty</strong></td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    
</div>

@endsection