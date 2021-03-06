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
        </div>

 
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">   
                        @php
                            if(Storage::exists('public/event/'.$event->foto_event)){
                                $path = Storage::url('event/'.$event->foto_event);
                            }else{
                                $path = Storage::url('default.jpg');
                            }   
                        @endphp
                        <div class="col-md-6">
                        <img src="{{ url($path)}}" width="100%">
                        </div>

                        <div class="col-md-6 mt-4">
                      
                            <form action="/tiket" method="post">
                                @csrf
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <input type="text" class="form-control" name="id_event" value="{{$event->id}}" hidden>
                                            <td>Nama Event</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">     
                                                <input type="text" class="form-control" name="nama_event" value="{{$event->nama_event}}" readonly>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Tiket</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                                <select name="jenis_tiket" id="jenis_tiket" class="form-control">
                                                    <option value="" selected disabled>---</option>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Premium">Premium</option>
                                                    <option value="VIP">VIP</option>
                                                    <option value="VVIP">VVIP</option>
                                                </select>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga Tiket</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                            <input type="number" class="form-control" name="harga_tiket" placeholder="Rp." min="0">
                                            </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Jumlah Tiket Yang Disediakan</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                            <input type="number" class="form-control" name="jumlah_tiket" min="1">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right mt-3"> Tambah Tiket</button>

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
