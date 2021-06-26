<li class="nav-item">
    <a class="nav-link" href="{{ route('cart.index') }}">
        Cart
        <span class="badge badge-success badge-pill">
            {{ $orderdetails ?? 0 }}</span>
    </a>
</li>