@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">CheckOut</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        
                        <div class="col-md-6">
                            Pilih Metode Pembayaran :

                            <form action="/checkout/update/{{$transaksi->id}}" method="post">
                                @csrf
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="radio" name="check" value="bank">
                                    <label class="form-check-label" for="defaultCheck1">
                                      Credit Card
                                    </label>
                                </div>
    
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="radio" name="check" value="gopay">
                                    <label class="form-check-label" for="defaultCheck1">
                                      GoPay
                                    </label>
                                </div>
    
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="radio" name="check" value="ovo">
                                    <label class="form-check-label" for="defaultCheck1">
                                       OVO
                                    </label>
                                </div>
    
                                <div class="form-check mt-4 mb-4">
                                    <input class="form-check-input" type="radio" name="check" value="dana">
                                    <label class="form-check-label" for="defaultCheck1">
                                      Dana
                                    </label>
                                </div>
                                <button class="btn btn-sm btn-success float-right mt-4" type="submit">Next -></button>
                            </form>
                            
                        </div>

                        <div class="col-md-6">

                            @php  
                            if(Storage::exists('public/event/'.$transaksi->tiket->event->foto_event)){
                                $path = Storage::url('event/'.$transaksi->tiket->event->foto_event);
                            }else{
                                $path = Storage::url('default.jpg');
                            }   

                            @endphp

                            <img src="{{$path}}" width="40%" height="40%">

                            <table class="table mt-4">
                                <tbody>
                                    <tr>
                                        <td>Nama Event : </td>
                                        <td>{{$transaksi->tiket->event->nama_event}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Dan Waktu : </td>
                                        <td>{{$transaksi->tiket->event->tanggal_event}} | {{$transaksi->tiket->event->waktu_event}}</td>
                                    </tr>
                                    <tr>
                                        <td>Detail : </td>
                                        <td>Rp. {{$transaksi->tiket->harga_tiket}} x {{$transaksi->jumlah_tiket}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga : </td>
                                        <td>Rp. <b>{{$transaksi->total_harga}}<b></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
