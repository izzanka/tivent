@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    Kategori : 
                    <a href="/kategori/{{'konser'}}" class="mr-2">konser</a>|
                    <a href="/kategori/{{'festival'}}" class="mr-2">festival</a>|
                    <a href="/kategori/{{'gaming'}}" class="mr-2">gaming</a>|
                    <a href="/kategori/{{'fashion'}}" class="mr-2">fashion</a>|
                    <a href="/kategori/{{'pameran'}}" class="mr-2">pameran</a>|
                    <a href="/kategori/{{'olahraga'}}" class="mr-2">olahraga</a>|
                    <a href="/kategori/{{'pendidikan'}}" class="mr-2">pendidikan</a>|
                    <a href="/kategori/{{'budaya'}}" class="mr-2">budaya</a>
                    
                </div>
                
            </div>
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
                    <h5 class="card-title text-uppercase font-weight-bold">{{$events->nama_event}}</h5>
                    <p class="card-text">
                        <strong>Tempat Event : </strong><br>
                        {{$events->tempat_event}}<br>
                        <strong>Waktu Event : </strong><br>
                        {{$events->waktu_event}}<br>
                        <strong>Tanggal  Event : </strong><br>
                        {{$events->tanggal_event}}<br>
                        <hr>
                    @guest
                        <a href="/detail/{{$events->id}}">Detail Event</a>
                    @else
                        @if ($events->user_id == Auth::user()->id)
                            @if ($events->status_event == 1 || $events->status_event == 2)
                                <a href="/event">Event</a>
                            @else
                                <a href="/event/{{$events->id}}/edit">Edit Event</a>
                            @endif
                        @else
                        <a href="/detail/{{$events->id}}">Detail Event</a>
                        @endif
                    @endguest
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
