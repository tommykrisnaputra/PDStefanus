@extends('master')

@section('title')
	Pendaftaran
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/auth/register.css') }}" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		@if ($errors->any())
			<div class="alert-toast">
				<div class="alert-toast-content">
					<div class="message">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</div>
				</div>
			</div>
		@endif
		<div class="container">
			<form method="POST" action="/register">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="full_name">Nama Lengkap</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('full_name') ? 'form-error' : '' }}" id="full_name" name="full_name" type="text"
							value="{{ old('full_name') }}" placeholder="Masukan nama">
					</div>
				</div>
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukan email" class="{{ $errors->has('email') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				<div class="row">
					<div class="col-25">
						<label for="phone">Nomor HP</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('phone') ? 'form-error' : '' }}" id="phone" name="phone" type="tel"
							value="{{ old('phone') }}" placeholder="Masukan nomor HP">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="birthdate">Tanggal Lahir</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('birthdate') ? 'form-error' : '' }}" id="birthdate" name="birthdate" type="date"
							value="{{ old('birthdate') }}" placeholder="Masukan tanggal lahir">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="social_instagram">Instagram</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('social_instagram') ? 'form-error' : '' }}" id="social_instagram"
							name="social_instagram" type="text" value="{{ old('social_instagram') }}" placeholder="Masukan tag Instagram">
					</div>
				</div>
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="social_tiktok">Tik Tok</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="social_tiktok" name="social_tiktok" value="{{ old('social_tiktok') }}"
                            placeholder="Masukan tag Tik Tok"
                            class="{{ $errors->has('social_tiktok') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            placeholder="Masukan alamat" class="{{ $errors->has('address') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				<div class="row">
					<div class="col-25">
						<label for="wilayah">Wilayah tempat tinggal</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('wilayah') ? 'form-error' : '' }}" id="wilayah" name="wilayah" type="text"
							value="{{ old('wilayah', $users->wilayah ?? '') }}"
							placeholder="Masukan wilayah tempat tinggal anda (Jelambar, Tj Duren, ...)">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="paroki">Paroki</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('paroki') ? 'form-error' : '' }}" id="paroki" name="paroki" type="text"
							value="{{ old('paroki') }}" placeholder="Masukan paroki">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="gender">Gender</label>
					</div>
					<div class="col-75">
						<select class="{{ $errors->has('gender') ? 'form-error' : '' }}" id="gender" name="gender" value="male"
							value="{{ old('gender') }}" placeholder="Masukan gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
				</div>
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="first_attendance">Pertama Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="first_attendance" name="first_attendance" value="<?php echo date('Y-m-d'); ?>"
                            placeholder="Masukan tanggal kedatangan pertama kali"
                            class="{{ $errors->has('first_attendance') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				<div class="row">
					<div class="col-25">
						<label for="password">Password</label>
					</div>
					<div class="col-75 password-container">
						<input class="{{ $errors->has('password') ? 'form-error' : '' }}" id="password" name="password" type="password"
							value="{{ old('password') }}" placeholder="Masukan Password">
						<i class="far fa-eye" id="eye"></i>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="password">Konfirmasi Password</label>
					</div>
					<div class="col-75 password-container">
						<input class="{{ $errors->has('password') ? 'form-error' : '' }}" id="password_confirmation"
							name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
							placeholder="Masukan ulang Password">
						<i class="far fa-eye" id="eye-confirmation"></i>
					</div>
				</div>
				<div class="row submit-button-container">
					<input class="submit-button" type="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
@endsection

@section('js')
	<script>
		const passwordInput = document.querySelector("#password")
		const eye = document.querySelector("#eye")
		eye.addEventListener("click", function() {
			this.classList.toggle("fa-eye-slash")
			const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
			passwordInput.setAttribute("type", type)
		})

		const passwordConfirmationInput = document.querySelector("#password_confirmation")
		const eyeConfirmation = document.querySelector("#eye-confirmation")
		eyeConfirmation.addEventListener("click", function() {
			this.classList.toggle("fa-eye-slash")
			const type = passwordConfirmationInput.getAttribute("type") === "password" ? "text" : "password"
			passwordConfirmationInput.setAttribute("type", type)
		})
	</script>
@endsection
