@php
    if(!empty($notifcart)){
    $notif = $notifcart->count();
    }
@endphp



<li class="nav-item">
    <a class="nav-link" href="/cart">
        Cart
        @if(!empty($notif)) 
            <span class="badge badge-warning badge-pill">
            {{ $notif }}</span>
        @endif
    </a>
</li>