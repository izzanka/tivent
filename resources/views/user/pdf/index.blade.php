<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ticket PDF</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
        @foreach ($orderdetails as $orderdetail)
            @php
                $ticket_code = json_decode($orderdetail->ticket_code);
                $n = 1;
            @endphp

            @for($i = 0; $i < $orderdetail->ticket_amount; $i++)
                <div class="col-md-6 mt-4 mb-6">
                    <div class="card-header border border-black">
                        {{$orderdetail->ticket->event->name}}
                        <h5 class="float-right">{{$n++}}</h5>
                    </div>
                    <div class="card-body border border-black">
                        <p class="card-text">
                            <div class="float-right">
                                <img src="{{ public_path('qrcodes/' . $ticket_code[$i] . '.svg')}}">
                            </div>
                            {{ $orderdetail->order->user->name }} | {{ $orderdetail->order->user->email }}<br>
                            {{ $orderdetail->ticket->type }} | {{ $ticket_code[$i] }}<br>
                            {{ $orderdetail->ticket->event->location }}<br>
                            {{ $orderdetail->ticket->event->date }} | {{ $orderdetail->ticket->event->getTime() }}
                        </p>
                    </div>
                </div>
                @if ($n % 5 == 0)
                    <div class="page-break"></div>
                @endif
            @endfor
        @endforeach
</body>
</html>