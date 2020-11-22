@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Tiket</li>
                </ol>
            </nav>

        </div>
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                        {{Session::get("success")}}
                        </div>
                    @endif

                    @if(session('error')) 
                        <div class="alert alert-danger" role="alert">
                        {{Session::get("error")}} 
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection












