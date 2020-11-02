@php
    if(!empty($notiforder)){
    $notif = $notiforder->count();
    }
@endphp



<li class="nav-item">
    <a class="nav-link" href="/cartadmin">
        Incoming Order
        @if(!empty($notif)) 
            <span class="badge badge-warning badge-pill">
            {{ $notif }}</span>
        @endif
    </a>
</li>