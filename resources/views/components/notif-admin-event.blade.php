@php
    if(!empty($event)){
    $notif = $event->count();
    }
@endphp



<li class="nav-item">
    <a class="nav-link" href="/allevent">
        All Event
        @if(!empty($notif)) 
            <span class="badge badge-danger badge-pill">
            {{ $notif }}</span>
        @endif
    </a>
</li>