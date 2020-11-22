@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bukti Pembayaran</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" width="100%" height="100%">
                        </div>
                        <div class="col-md-6 mt-4">
                        <form action="/transaksi/store/bukti/{{$transaksi->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <tbody>
                                    <tr>
                                   
                                        <td>Informasi </td>
                                        <td>:</td>
                                        <td>
                                        <h5>Harap melakukan pembayaran ke nomor rekening : <strong>{{$rek->nomor_rekening}}</strong> sebesar Rp. <strong>{{$transaksi->total_harga}}</strong></h5>
                                        <br>
                                        </td>                           
                                            
                                    </tr>
                                 
                                    <tr>
                                   
                                        <td>Upload Foto Bukti Pembayaran </td>
                                        <td>:</td>
                                        <td>
                                            <input type="file" class="form-control-file" name="bukti_pembayaran" accept="image/*">
                                            <br>
                                            <button type="submit" class="btn btn-primary float-right mt-3"> Upload</button>

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
