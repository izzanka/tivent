@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>

        </div>

        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="/profile/{{$user->id}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-8 mb-4">
                                    <label >Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" name="name">
                                @error('name')
                                <span class="error text-danger">{{$message}}</span>
                                @enderror
                                </div>
                               
                                <div class="col-8 mb-4">
                                    <label >Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" name="email" >
                                @error('email')
                                <span class="error text-danger">{{$message}}</span>
                                @enderror
                                </div>

                                <div class="col-8 mb-4">
                                    <label >Nomor Rekening</label>
                                <input id="nomor_rekening" type="number" class="form-control @error('nomor_rekening') is-invalid @enderror" value="{{$user->nomor_rekening}}" name="nomor_rekening" >
                                @error('nomor_rekening')
                                <span class="error text-danger">{{$message}}</span>
                                @enderror
                                </div>
                                
                            </div>
                            <button class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="/profile/{{$user->id}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-10 mb-4">
                                    <label >New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                    @error('password')
                                    <span class="error text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-10 mb-4">
                                    <label >Confirm New Password</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                            <button class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h6 class="float-left">Delete Account</h6><br>
                    <h6 class="float-left text-danger">Once your account is deleted, all of its resources and data will be permanently deleted</h6>
                        <form action="/profile/{{$user->id}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger float-right" type="submit">DELETE ACCOUNT</button>
                        </form>
                </div>
            </div>
        </div>

        
        
    </div>
</div>
@endsection






