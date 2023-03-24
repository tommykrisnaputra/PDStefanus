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
        @auth
            {{-- {{ auth()->user()->role_id }} --}}
            @if (auth()->user()->isAdmin())
                <a href="/users">Umat</a>
            @endif
            <a href="{{ route('logout.perform') }}" class="solid-button-container">
                <button class="solid-button-button button Button">
                    <span>Logout</span>
                </button>
            </a>
        @endauth

        @guest
            <a href="/login" class="solid-button-container">
                <button class="solid-button-button button Button">
                    <span>Login</span>
                </button>
            </a>
        @endguest
    </div>
</div>
