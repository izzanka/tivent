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
                <h3 class="mb-3"> Pesanan</h3>
                
                
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Event</th>
                                <th>Penyelenggara</th>
                                <th>Jenis Tiket</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($transaksi as $t)
                        
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        @if($t->tiket)
                                        <td>{{$t->user->name}}</td>
                                        <td><a href="/detail/{{$t->tiket->event->id}}">{{$t->tiket->event->nama_event}}</a></td>
                                        <td>{{$t->tiket->event->user->name}}</td>
                                        <td>{{$t->tiket->jenis_tiket}}</td>
                                        <td>{{$t->jumlah_tiket}}</td>
                                        <td>Rp. {{$t->total_harga}}</td>
                                        @php
                                            if(Storage::exists('public/bukti/'.$t->bukti_pembayaran)){
                                                $path = Storage::url('bukti/'.$t->bukti_pembayaran);
                                            }else{
                                                $path = Storage::url('default.jpg');
                                            }   
                                        @endphp
                                        <td> <img src="{{ url($path) }}" width="200px" height="200px"></td>
                                        <td>
                                            <a href="/order/konfirmasi/{{$t->id}}">Berhasil Dikonfirmasi |</a>
                                            <a href="/order/gagalkonfirmasi/{{$t->id}}">Gagal Dikonfirmasi |</a>
                                            <a href="/order/cancel/{{$t->id}}">Batalkan pesanan</a>
                                     
                                        </td>
                                        @else
                                        <td>{{$t->user->name}}</td>
                                        <td>Tiket Dihapus</td>
                                        <td>Tiket Dihapus</td>
                                        <td>Tiket Dihapus</td>
                                        <td>{{$t->jumlah_tiket}}</td>
                                        <td>{{$t->total_harga}}</td>
                                        <td><img src="{{ url($path) }}"></td>
                                        <td><a href="">Hapus pesanan</td>
                                        @endif
                                       
                                  
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



