@extends('layouts.app')
@section('title')
    Create Ticket
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
                    <li class="breadcrumb-item"><a href="{{ route('ticket.index',$event->id) }}" class="text-dark">Ticket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        
    </div>
    
    <form method="post" action="{{ route('ticket.store',$event->id) }}">
        @csrf
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
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ $event->name }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <select name="type" class="form-control @error('type') is-invalid @enderror" >
                                            <option value="" selected disabled>-- Select Type --</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Premium">Premium</option>
                                            <option value="Vip">VIP</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>:</td>
                                <td>
                                <div class="form-group">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Rp." min="0" value="{{ old('price') }}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Amount</td>
                                <td>:</td>
                                <td>
                                <div class="form-group">
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount"  min="1" value="{{ old('amount') }}">
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </td>
                            </tr>

                            <tr>    
                                <td colspan="3">
                                    <button type="submit" class="btn btn-dark btn-block">Create Ticket</button>
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                        
            </div>
        </div>
    
    </div>
</div>
@endsection