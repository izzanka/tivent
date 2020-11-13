@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tiket</li>

                </ol>
            </nav>
            
        </div>
       
        @foreach ($transaksi as $t)
        
        <div class="col-md-12 mt-4">
            <div class="card">
            @if ($t->tiket)
            <div class="card-header">
                {{$t->tiket->event->nama_event}}
                <a href="/pdf/cetak/{{$t->id}}" class="btn btn-primary float-right ml-3">Print</a>
                <a href="/transaksi/cancel/{{$t->tiket->id}}" class="btn btn-danger float-right">Cancel</a>
            </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $kode = $t->kode_tiket;
                            $kode_tiket = explode(",",$kode);
                            $n = 1;
                        @endphp
                        @for ($i = 0; $i < $t->jumlah_tiket; $i++)
                            <div class="col-sm-4 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="float-right">{{$n++}}</h5>
                                    <p class="card-text">
                                        {{$t->tiket->jenis_tiket}}<br>
                                        {{$t->tiket->event->tempat_event}}<br>
                                        {{$t->tiket->event->tanggal_event}}<br>
                                        {{$t->tiket->event->waktu_event}}<br>
                                    </p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @else
            <div class="card-header">
                Event sudah dihapus
                <a href="#" class="btn btn-secondary float-right">Print</a>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $kode = $t->kode_tiket;
                        $kode_tiket = explode(",",$kode);
                        $n = 1;
                    @endphp
                    @for ($i = 0; $i < $t->jumlah_tiket; $i++)
                        <div class="col-sm-4 mt-2">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Tiket sudah dihapus</h5>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            @endif
            
            </div>
        </div>
        @endforeach
        <div class="mt-4 float-right">
            {{ $transaksi->links() }}
        </div>
    </div>
</div>
@endsection
