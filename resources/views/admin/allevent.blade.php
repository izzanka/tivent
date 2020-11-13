@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> All Event</li>
                </ol>
            </nav>

        </div>

    
        @foreach($event as $events)
        <div class="col-md-3 mt-2">
            <div class="card">
                @php
                if(Storage::exists('public/event/'.$events->foto_event)){
                    $path = Storage::url('event/'.$events->foto_event);
                }else{
                    $path = Storage::url('default.jpg');
                }   
                @endphp
                <img src="{{ url($path) }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">{{$events->nama_event}}</h5>
                    <p class="card-text">
                        <strong>Tempat Event : </strong><br>
                        {{$events->tempat_event}}<br>
                        <strong>Waktu Event : </strong><br>
                        {{$events->waktu_event}}<br>
                        <strong>Tanggal  Event : </strong><br>
                        {{$events->tanggal_event}}<br>
                        @if ($events->deleted_at == null)
                        <hr>
                        <form action="/event/{{$events->id}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-3">delete event</button>
                        </form>
                        @endif
                        
                    </p>          
                </div>
            </div>
        </div>
        @endforeach

        

    </div>
    <div class="mt-4 float-right">
        {{ $event->links() }}
    </div>
</div>
@endsection
