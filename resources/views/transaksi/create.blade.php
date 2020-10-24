@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @php
                            $path = Storage::url('event/'.$tiket->event->foto_event);
                            @endphp
                            <img src="{{url($path)}}" width="100%" height="100%">
                        </div>
                        <div class="col-md-6 mt-4">
                            <h1 class="mb-4">{{$tiket->event->nama_event}}</h1>
                            <form action="/transaksi/store/{{$tiket->id}}" method="post">
                            @csrf
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Jenis Tiket</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="jenis_tiket" value="{{$tiket->jenis_tiket}}" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga Tiket</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="harga_tiket" value="{{$tiket->harga_tiket}}" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tiket Yang Tersedia</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="jumlah_tiket" value="{{$tiket->jumlah_tiket}}" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tiket Yang Dipesan</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="jumlah_tiket" min="1">
                                                <button type="submit" class="btn btn-primary float-right mt-3"> Pesan Tiket</button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
