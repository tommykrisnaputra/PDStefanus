<div class="nav home-navbar">
    <input type="checkbox" id="nav-check">
    @guest
        <img alt="image" src="{{ asset('images/logo pd.png') }}" loading="lazy" class="home-image" />
    @endguest
    @auth
        <a href={{ route('notification.index') }}>
            <img alt="image"
                src="{{ asset(Auth::user() && auth()->user()->hasNotification() ? 'images/notification-bell.png': 'images/notification.png') }}"
                loading="lazy" class="notify-image" />
        </a>
    @endauth
    @guest
        <div class="nav-header">
            <div class="nav-title">
                <p>PD OMPKK St. Stefanus</p>
                <p>@yield('title')</p>
            </div>
        </div>
    @endguest
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>
    <div class="nav-links">
        <a href={{ route('index') }}>Home</a>
        @guest
            <a href={{ route('register.show') }}>Pendaftaran</a>
            <a href={{ route('attendance.show') }}>Kehadiran</a>
        @endguest
        @auth
            @if (auth()->user()->isAdmin())
                <a href={{ route('users.show') }}>Umat</a>
                <a href={{ route('attendance.index') }}>Kehadiran</a>
                <a href={{ route('temapd.show') }}>Tema PD</a>
                <a href={{ route('events.show') }}>Kegiatan PD</a>
                <a href={{ route('users.changepassword') }}>Update Password</a>
            @endif
            <a href={{ route('users.selfedit') }}>Update Data</a>
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
