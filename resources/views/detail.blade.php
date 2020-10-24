@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/event">Event</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Event</li>
                </ol>
            </nav>

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        @php
                            if(Storage::exists('public/event/'.$event->foto_event)){
                                $path = Storage::url('event/'.$event->foto_event);
                            }else{
                                $path = Storage::url('default.jpg');
                            }   
                        @endphp
                            <img src="{{url($path)}}" width="100%">
                        </div>
                        <div class="col-md-6 mt-4">
                            
                       
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama Event</td>
                                        <td>:</td>
                                        <td>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="nama_event" value="{{$event->nama_event}}" readonly>
                                        </div>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>Deskripsi Event</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="deskripsi_event" value="{{$event->deskripsi_event}}" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                   
                                        <td>Kategori Event</td>
                                        <td>:</td>
                                        <td>
                                        <input type="text" class="form-control" name="kategori_event" value="{{$event->kategori_event}}" readonly>
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Tempat Event</td>
                                        <td>:</td>
                                        <td>
                                        <input type="text" class="form-control" name="tempat_event" value="{{$event->tempat_event}}" readonly>
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Waktu Event</td>
                                        <td>:</td>
                                        <td>
                                        <input type="time" class="form-control" name="waktu_event" value="{{$event->waktu_event}}" readonly>
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Tanggal Event</td>
                                        <td>:</td>
                                        <td>
                                        <input type="date" class="form-control" name="tanggal_event" value="{{$event->tanggal_event}}" readonly>
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Penyelenggara</td>
                                        <td>:</td>
                                        <td>
                                        <input type="text" class="form-control" name="penyelenggara" value="{{$event->user->name}}" readonly>
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Jenis Tiket Yang Tersedia</td>
                                        <td>:</td>
                                        <td>
                                        
                                            @if ($event->status_event == 1)
                                                <a href="#" class="text-success">Event Sedang Dimulai</a>
                                            @elseif($event->status_event == 2)
                                                <a href="#" class="text-danger">Event Sudah Selesai</a>
                                            @else
                                                @foreach ($tiket as $tikets)
                                                    @if ($tikets->jumlah_tiket == 0)
                                                    <a href="#" class="btn btn-danger btn-sm d-flex justify-content-center mb-3"></i> Tiket {{$tikets->jenis_tiket}} Habis</a>
                                                    @else
                                                    <a href="/transaksi/create/{{$tikets->id}}" class="btn btn-primary btn-sm d-flex justify-content-center mb-3"></i> Pesan Tiket {{$tikets->jenis_tiket}}</a>
                                                    @endif
                                                @endforeach
                                            @endif
                                         
                                        </td>                           
                                            
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
