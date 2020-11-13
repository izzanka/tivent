<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tiket PDF</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
        @foreach ($transaksi as $t)
            @php
                $kode = $t->kode_tiket;
                $kode_tiket = explode(",",$kode);
                $n = 1;
            @endphp

            @for($i = 0; $i < $t->jumlah_tiket; $i++)
                <div class="col-md-6 mt-5 mb-5">
                  
                    <div class="card-header border border-black">
                        {{$t->tiket->event->nama_event}} | {{$t->tiket->jenis_tiket}}
                        <h5 class="float-right">{{$n++}}</h5>
                    </div>
                    <div class="card-body border border-black">
                        <p class="card-text">
                            <div class="float-right">
                                <img src="{{ public_path('storage/qrcodes/' .$kode_tiket[$i]. '.svg')}}">
                            </div>
                            {{$t->tiket->event->kategori_event}}<br>
                            {{$t->tiket->event->tempat_event}}<br>
                            {{$t->tiket->event->tanggal_event}}<br>
                            {{$t->tiket->event->waktu_event}}<br>
                         
                        </p>
                    </div>

                        
                </div>
            @endfor
        @endforeach
</body>
</html>