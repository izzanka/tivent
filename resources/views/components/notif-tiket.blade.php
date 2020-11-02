@php
    if(!empty($notiftiket)){
    $notif = $notiftiket->count();
    }
@endphp



<li class="nav-item">
    <a class="nav-link" href="/tiketcart">
        Tiket
        @if(!empty($notif)) 
            <span class="badge badge-success badge-pill">
            {{ $notif }}</span>
        @endif
    </a>
</li>