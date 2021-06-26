@extends('layouts.app')
@section('title')
    History Order
@endsection
@section('content')

<div class="container">
    <div class="row mt-2 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History Order</li>
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
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
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
                                <td>
                                    {{ $order->user->name }}
                                    <br>
                                    {{ $order->user->email }}
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                @php
                                    $orderdetails = \App\Models\OrderDetail::with('ticket')->where('order_id',$order->id)->get();
                                    $total_order = $orderdetails->sum('ticket_amount');
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
                                <td>{{ $total_order }}</td>
                                <td>
                                    @if($order->status == 3)
                                        Order successfully confirmed
                                    @elseif($order->status == 4)
                                        Order failed to confirm
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                        <td colspan="9"><b>Order Empty</b></td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection