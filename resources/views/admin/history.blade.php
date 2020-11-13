@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>

        </div>
        
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                <h3 class="mb-3"> History</h3>
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
                                <th>Status</th>
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
                                        <td>{{$t->status}}</td>
                                                                      
                                        @else
                                        <td>{{$t->user->name}}</td>
                                        <td>Tiket Dihapus</td>
                                        <td>Tiket Dihapus</td>
                                        <td>Tiket Dihapus</td>
                                        <td>{{$t->jumlah_tiket}}</td>
                                        <td>{{$t->total_harga}}</td>
                                        <td>{{$t->status}}</td>
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



