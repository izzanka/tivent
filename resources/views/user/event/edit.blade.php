@extends('layouts.app')
@section('title')
    Edit Event
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Event</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
    
    <form enctype="multipart/form-data" method="post" action="{{ route('events.update',$event->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="row">
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
        

            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <table class="table" style="border-top : hidden">
                            <tr>
                                <td>Name Event</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ $event->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td>
                                    <textarea name="description" id="" cols="15" rows="5" class="form-control">{{ $event->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>:</td>
                                <td>
                                    <select name="category" class="form-control">
                                        <option value="{{ $event->category }}" selected disabled>{{ $event->category }}</option>
                                        <option value="" disabled>-- Select Category --</option>
                                        <option value="concert">concert</option>
                                        <option value="festival">festival</option>
                                        <option value="game">game</option>
                                        <option value="fashion">fashion</option>
                                        <option value="exhibition">exhibition</option>
                                        <option value="sport">sport</option>
                                        <option value="education">education</option>
                                        <option value="culture">culture</option>
                                    </select>
                                    
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>

                                    
                            <tr>
                                <td>Location</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="location"
                                        class="form-control @error('location') is-invalid @enderror" value="{{ $event->location}}">
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td>
                                    <input type="date" name="date"
                                        class="form-control @error('date') is-invalid @enderror" value="{{ $event->date }}">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td>Time</td>
                                <td>:</td>
                                <td>
                                    <input type="time" name="time"
                                        class="form-control @error('time') is-invalid @enderror" value="{{ $event->time }}">
                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                          
                            <tr>
                                <td>Image</td>
                                <td>:</td>
                                <td>
                                    <input type="file" accept="image/*" class="form-control @error('images') is-invalid @enderror"  name="images[]" onchange="loadFile(event)" multiple>

                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
 
                                
                            </tr>
                            <tr>    
                                <td colspan="3">
                                    <button type="submit" class="btn btn-dark btn-block">Edit Event</button>
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
<script>

    var loadFile = function(event){
        var output = document.getElementById('preview_img');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
    
</script>
@endsection