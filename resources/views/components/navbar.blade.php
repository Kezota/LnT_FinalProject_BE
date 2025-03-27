<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container container-fluid">
        <a class="navbar-brand" href="/">ChipiChapa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                @if (Auth::guard('user')->check())
                    <a class="nav-link {{ request()->is('user/catalog') ? 'active' : '' }}" href="{{ route('user.catalog') }}">Catalog</a>
                    <a class="nav-link {{ request()->is('user/cart') ? 'active' : '' }}" href="{{ route('user.cart') }}">Cart</a>
                @elseif (Auth::guard('admin')->check())
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a class="nav-link {{ request()->is('admin/add-product') ? 'active' : '' }}" href="{{ route('admin.addProduct') }}">Add Product</a>
                @endif
            </div>

            <div class="navbar-nav ms-auto">
                @if (Auth::guard('user')->check() || Auth::guard('admin')->check())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Logout</button>
                    </form>
                @else
                    <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login</a>
                    <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="/register">Signup</a>
                @endif
            </div>
        </div>
    </div>
</nav>
