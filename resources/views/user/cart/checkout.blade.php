@extends('layouts.app')
@section('title')
    Checkout
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Cart</li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
    
        <div class="col-md-12 mt-2">
            <h5><i class="bi bi-credit-card"></i> Payment Information</h5>
            <hr>
            <p><h5 class="text-danger">Please do the transfer before 24 hours, otherwise the order will be automatically failed</h5></p>
            <p><h5>Transfer to the account below for :<br><u><strong> Rp. {{ number_format($order->total_price) }}</strong></u> </h5></p>
             <div class="media mt-3">
                <img class="mr-3" src="{{ asset('assets/payment/bca.png') }}" width="60">
                <div class="media-body">
                    <h5 class="mt-0">BANK BCA</h5>
                    Account Number <strong>012355-678-910</strong> / <strong>Izzan Khairil Anam</strong>
                </div>
            </div>
            <div class="media mt-3 mb-2">
                <img class="mr-3" src="{{ asset('assets/payment/paypal.png') }}" width="60">
                <div class="media-body">
                    <h5 class="mt-0">PAYPAL</h5>
                    Account Number <strong>012345-678-910</strong> / <strong>Izzan Khairil Anam</strong>
                </div>
            </div>
        </div>
        
    </div>
    <form action="{{ route('checkout',$order->id) }}" method="POST">
        @csrf
        <button class="btn btn-block btn-outline-success mt-2"type="submit" onclick="return confirm('Are you sure?')">Checkout Order</button>
    </form>
    <a class="btn btn-block btn-outline-danger mt-2" href="" onclick="return confirm('Are you sure?')">Cancel Order</a>

</div>

@endsection