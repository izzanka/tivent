@php
    if(!empty($notifhistory)){
    $notif = $notifhistory->count();
    }
@endphp



<li class="nav-item">
    <a class="nav-link" href="/history">
        History
        @if(!empty($notif)) 
            <span class="badge badge-primary badge-pill">
            {{ $notif }}</span>
        @endif
    </a>
</li>