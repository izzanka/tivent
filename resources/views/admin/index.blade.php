@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="/home" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                </ol>
            </nav>

        </div>
        
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                <h3 class="mb-3"><i class="fas fa-shopping-cart"></i> Pesanan</h3>
                
                
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Event</th>
                                <th>Penyelenggara</th>
                                <th>Jenis Tiket</th>
                                <th>Harga Tiket</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $t)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$t->user->name}}</td>
                                <td>{{$t->tiket->event->nama_event}}</td>
                                <td>{{$t->tiket->event->user->name}}</td>
                                <td>{{$t->tiket->jenis_tiket}}</td>
                                <td>Rp. {{$t->tiket->harga_tiket}}</td>
                                <td>{{$t->jumlah_tiket}}</td>
                                <td>Rp. {{$t->total_harga}}</td>
                                <td>{{$t->status}}</td>
                                @php
                                $path = Storage::url('bukti/'.$t->bukti_pembayaran);
                                @endphp
                                <td>
                                    <img src="{{url($path)}}" width="100%">
                                </td>
                                <td>
                                    <a href="/admin/{{$t->id}}/edit">Konfirmasi</a>
                                    |
                                    <a href="">Tidak Dapat Dikonfirmasi</a>
                                    |
                                    <a href="">Generate Tiket</a>

                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    </div>
             

            </div>
        </div>

    </div>
</div>
@endsection



