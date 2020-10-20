@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="/" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tiket</li>
                </ol>
            </nav>
        </div>

      
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @php
                            $path = Storage::url('event/'.$tiket->event->foto_event);
                        @endphp
                        <div class="col-md-6">
                        <img src="{{url($path)}}" width="100%">
                        </div>

                        <div class="col-md-6 mt-4">
                      
                            <form action="/tiket/{{$tiket->id}}" method="post">
                                @method('PUT')
                                @csrf
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nama Event</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                    
                                                <input type="text" class="form-control" name="nama_event" value="{{$tiket->event->nama_event}}" readonly>
                                    
                                            </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Jenis Tiket</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                            <input type="text" class="form-control" name="jenis_tiket" value="{{$tiket->jenis_tiket}}">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Harga Tiket</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                            <input type="number" class="form-control" name="harga_tiket" placeholder="Rp." value="{{$tiket->harga_tiket}}">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Jumlah Tiket Yang Disediakan</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                            <input type="number" class="form-control" name="jumlah_tiket" value="{{$tiket->jumlah_tiket}}" min="1">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right mt-3"> Edit Tiket</button>

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
