@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @foreach ($events as $event)
    <div class="col-md-6 mt-4">
      <div class="card">
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
        <div class="card-body">
          <h5 class="card-title"><b>{{ $event->name }}</b></h5>
          <p class="card-text">{{ $event->description }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Location : {{ $event->location }}</li>
          <li class="list-group-item">Date     : {{ $event->date }}</li>
          <li class="list-group-item">Time     : {{ $event->getTime($event->time) }}</li>
        </ul>
        <div class="card-body">
            <a href="{{ route('event.detail',$event->id) }}" class="card-link">Detail</a>
        </div>
      </div>
    </div>
    @endforeach
   
  </div>
</div>
@endsection
