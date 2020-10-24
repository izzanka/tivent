@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tiket</li>

                </ol>
            </nav>
        <a href="/tiket/create/{{$event->id}}" class="btn btn-primary float-right btn-sm">Tambah Tiket</a>
            <h3 class="mb-1 float-left"> Tiket</h3>
            
        </div>


    
        @foreach($tiket as $tikets)
        <div class="col-md-3 mt-4">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jenis tiket : {{$tikets->jenis_tiket}}</h5>
                <p class="card-text">
                    Harga Tiket : {{$tikets->harga_tiket}}<br>
                    Jumlah Tiket : {{$tikets->jumlah_tiket}}
                </p>
                
                <form action="/tiket/{{$tikets->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">delete tiket</button>
                </form>      

                <a href="/tiket/{{$tikets->id}}/edit" class="btn btn-primary btn-sm">edit tiket</a>
                
            </div>
            </div>         
        </div>
        @endforeach

        
         
    </div>
</div>
@endsection
