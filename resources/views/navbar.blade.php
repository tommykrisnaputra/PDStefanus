<div class="nav home-navbar home-top-container">
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
        <a>Info Paroki</a>
        <a href="/users" class="solid-button-container">
            <button class="solid-button-button button Button">
                <span>Login</span>
            </button>
        </a>
    </div>
</div>
