<div class="nav home-navbar">
	<input id="nav-check" type="checkbox">
	@guest
		<img class="home-image" src="{{ asset('images/logo pd.png') }}" alt="image" loading="lazy" />
	@endguest
	@auth
		<a href={{ route('notification.index') }}>
			<img class="notify-image"
				src="{{ asset(Auth::user() && auth()->user()->hasNotification() ? 'images/notification-bell.png' : 'images/notification.png') }}"
				alt="image" loading="lazy" />
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
				<a href={{ route('team-events.show') }}>Absensi PD</a>
				<a href={{ route('aba.show') }}>ABA</a>
				<a href={{ route('users.changepassword') }}>Update Password</a>
			@endif
			<a href={{ route('users.selfedit') }}>Update Data</a>
			<a class="solid-button-container" href="{{ route('logout.perform') }}">
				<button class="solid-button-button button Button">
					<span>Logout</span>
				</button>
			</a>
		@endauth
		@guest
			<a class="solid-button-container" href="/login">
				<button class="solid-button-button button Button">
					<span>Login</span>
				</button>
			</a>
		@endguest
	</div>
</div>
