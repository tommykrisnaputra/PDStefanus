<div class="nav home-navbar">
    <input type="checkbox" id="nav-check">
    <img alt="image" src="{{ asset('images/logo1-600h.png') }}" loading="lazy" class="home-image" />
    <div class="nav-header">
        <div class="nav-title">
            <p>PD OMPKK St. Stefanus</p>
            <p>@yield('title')</p>
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>
    <div class="nav-links">
        <a href="/">Home</a>
        <a href="/register">Pendaftaran</a>
        <a href="/users">Umat</a>
        <a href="/login" class="solid-button-container">
            <button class="solid-button-button button Button">
                <span>Login</span>
            </button>
        </a>
        @auth
            {{ auth()->user()->name }}
            <div class="text-end">
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
            </div>
        @endauth

        @guest
            <div class="text-end">
                <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
            </div>
        @endguest
    </div>
</div>
