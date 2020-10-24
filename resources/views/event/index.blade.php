@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event</li>
                </ol>
            </nav>
            <a href="event/create" class="btn btn-primary float-right btn-sm">Tambah Event</a>
            <h3 class="mb-1 float-left"> Event</h3>
            
        </div>


    
        @foreach($event as $events)
        <div class="col-md-3 mt-4">
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
                <h5 class="card-title">{{$events->nama_event}}</h5>
                
              
                <p class="card-text">
                    Deskrispi : {{$events->deskripsi_event}}<br>
                    Tempat    : {{$events->tempat_event}}<br>
                    Waktu     : {{$events->waktu_event}}<br>
                    Tanggal   : {{$events->tanggal_event}}
                </p>
                @if ($events->status_event == 0)
                    <a href="/event/mulai/{{$events->id}}" class="btn btn-success btn-sm">Mulai Event</a>
                    <a href="/event/{{$events->id}}/edit" class="btn btn-primary btn-sm">Edit event</a>
                    <a href="/tiket/{{$events->id}}" class="btn btn-primary btn-sm">Tiket</a>
                    <form action="/event/{{$events->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-3">delete event</button>
                    </form>
                @elseif($events->status_event == 1)
                    <small class="text-success">Event Sedang Dimulai</small><br>
                    <a href="/event/selesai/{{$events->id}}" class="btn btn-danger btn-sm">Event Selesai</a>
                @elseif($events->status_event == 2)
                    <small class="text-danger">Event Sudah Selesai</small><br>
                    <form action="/event/{{$events->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-3">delete event</button>
                    </form>
                @endif

                <br>
            

                
            </div>
            </div>         
        </div>
        @endforeach

        
         
    </div>
</div>
@endsection
