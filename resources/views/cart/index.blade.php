@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>

        </div>
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3"><i class="fas fa-shopping-cart"></i> Cart</h3>
                    <small>Upload bukti pembayaran maksimal satu hari sebelum event dimulai</small>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Event</th>
                                    <th>Jenis Tiket</th>
                                    <th>Harga Tiket</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($transaksi as $t)
                        
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        @if($t->tiket)
                                        <td><a href="/detail/{{$t->tiket->event->id}}">{{$t->tiket->event->nama_event}}</a></td>
                                        <td>{{$t->tiket->jenis_tiket}}</td>
                                        <td>Rp. {{$t->tiket->harga_tiket}}</td>
                                        <td>{{$t->jumlah_tiket}}</td>
                                        <td>Rp. {{$t->total_harga}}</td>
                                            @if ($t->tiket->event->status_event == 1)
                                                <td>Event Sudah Dimulai</td>
                                            @elseif($t->tiket->event->status_event == 2)
                                                <td>Event Sudah Selesai</td>
                                            @elseif($t->status == 1)
                                                <td>Pembayaran Sedang Dikonfirmasi</td>
                                            @elseif($t->status == 2)
                                                <td>Pembayaran Berhasil Dikonfirmasi | <a href="/tiketcart"> Check Tiket</a></td>
                                            @elseif($t->status == 3)
                                                <td>Pembayaran Gagal Dikonfirmasi</td>
                                            @elseif($t->status == 4)
                                                <td>Pesanan dibatalkan</td>
                                            @else
                                            <td>Belum Melakukan Pembayaran | <a href="/checkout/{{$t->id}}"> Checkout</a></td>
                                            @endif
                                            <td><a href="/transaksi/cancel/{{$t->tiket->id}}">Batalkan pesanan</a></td>
                                        @else
                                        <td>Tiket Dihapus</td>
                                        <td>Tiket Dihapus</td>
                                        <td>Tiket Dihapus</td>
                                        <td>{{$t->jumlah_tiket}}</td>
                                        <td>{{$t->total_harga}}</td>
                                        <td>Tiket Dihapus</td>
                                        <td><a href="/transaksi/delete/{{$t->id}}">Hapus pesanan</a></td>
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
</div>
@endsection