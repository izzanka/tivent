@php
    if(!empty($notifevent)){
    $notif = $notifevent->count();
    }
@endphp



<li class="nav-item">
    <a class="nav-link" href="/event">
        Event
        @if(!empty($notif)) 
            <span class="badge badge-primary badge-pill">
            {{ $notif }}</span>
        @endif
    </a>
</li>