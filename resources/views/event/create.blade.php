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
                            <img src="" width="100%">
                        </div>
                        <div class="col-md-6 mt-4">
                            
                            <form action="/event" method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama Event</td>
                                        <td>:</td>
                                        <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nama_event">
                                        </div>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>Deskripsi Event</td>
                                        <td>:</td>
                                        <td>
                                            <textarea class="form-control" name="deskripsi_event" rows="3" placeholder="Deskripsi..."></textarea>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Kategori Event</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="kategori_event">
                                                    <option value="konser">Konser</option>
                                                    <option value="festival">Festival</option>
                                                    <option value="gaming">Gaming</option>
                                                    <option value="fashion">Fashion</option>
                                                    <option value="pameran">Pameran</option>
                                                    <option value="olahraga">Olahraga</option>
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
                                            <input type="text" class="form-control" name="tempat_event" >
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Waktu Event</td>
                                        <td>:</td>
                                        <td>
                                            <input type="time" class="form-control" name="waktu_event" >
     
                                        </td>                           
                                            
                                    </tr>
                                    <tr>
                                   
                                        <td>Tanggal Event</td>
                                        <td>:</td>
                                        <td>
                                            <input type="date" class="form-control" name="tanggal_event" >
     
                                        </td>                           
                                            
                                    </tr>
    
                                    <tr>
                                   
                                        <td>Foto Event</td>
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
                                            <br>
                                            <button type="submit" class="btn btn-primary float-right mt-3"> Tambah Event</button>

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
