@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event</li>
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
                      
                            <form action="/event/{{$event->id}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Nama Event</td>
                                            <td>:</td>
                                            <td>
                                            <div class="form-group">
                                            <input type="text" class="form-control" name="nama_event" value="{{$event->nama_event}}">
                                            </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Deskripsi Event</td>
                                            <td>:</td>
                                            <td>
                                                <textarea class="form-control" name="deskripsi_event" rows="3">{{$event->deskripsi_event}}</textarea>
                                            </td>
                                            
                                        </tr>

                                        <tr>
                                            <td>Kategori Event</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" name="kategori_event">
                                                        <option value="{{$event->kategori_event}}">{{$event->kategori_event}}</option>
                                                        <option value="">--------</option>
                                                        <option value="konser">konser</option>
                                                        <option value="festival">festival</option>
                                                        <option value="gaming">gaming</option>
                                                        <option value="fashion">fashion</option>
                                                        <option value="pameran">pameran</option>
                                                        <option value="olahraga">olahraga</option>
                                                        <option value="pendidikan">Pendidikan</option>
                                                        <option value="budaya">Budaya</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tempat Event</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="tempat_event" value="{{$event->tempat_event}}">
                                                </div>
                                            </td>
                                            
                                        </tr>

                                        <tr>
                                            <td>Waktu Event</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="time" class="form-control" name="waktu_event" value="{{$event->waktu_event}}">
                                                </div>
                                            </td>
                                            
                                        </tr>

                                        <tr>
                                            <td>Tanggal Event</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="tanggal_event" value="{{$event->tanggal_event}}">
                                                </div>
                                            </td>
                                            
                                        </tr>
        
        
                                        <tr>
                                       
                                            <td>Foto Event </td>
                                            <td>:</td>
                                            <td>
                                                <input type="file" class="form-control-file" name="foto_event" accept="image/*">
                                            </td>                           
                                                
                                        </tr>
                                        <tr>
                                       
                                            <td>Upload Foto Dengan Ktp </td>
                                            <td>:</td>
                                            <td>
                                                <input type="file" class="form-control-file" name="foto_identitas" accept="image/*">
                                                <button type="submit" class="btn btn-primary float-right mt-3"><i class="fas fa-shopping-cart"></i> Edit Event</button>
                                            </td>                           
                                                
                                        </tr>
                                        <tr>
                                       
    
                                                               
                                                
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
