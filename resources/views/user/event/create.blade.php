@extends('layouts.app')
@section('title')
    Create Event
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Event</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        
    </div>
    
    <form enctype="multipart/form-data" method="post" action="{{ route('events.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
            
            <img class="img-fluid" id="preview_img" alt="*preview" width="210" height="200">

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
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}">
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
                                    <textarea name="description" id="" cols="15" rows="5" class="form-control">{{ old('name')}}</textarea>
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
                                        <option value="" selected disabled>-- Select Category --</option>
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
                                        class="form-control @error('location') is-invalid @enderror" value="{{ old('location')}}">
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
                                        class="form-control @error('date') is-invalid @enderror" value="{{ old('date')}}">
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
                                        class="form-control @error('time') is-invalid @enderror" value="{{ old('time')}}">
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
                                    <input type="file" accept="image/*" class="form-control" name="images[]" onchange="loadFile(event)" multiple>

                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
 
                                
                            </tr>
                            <tr>    
                                <td colspan="3">
                                    <button type="submit" class="btn btn-dark btn-block">Create Event</button>
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