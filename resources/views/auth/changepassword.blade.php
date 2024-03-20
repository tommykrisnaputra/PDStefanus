@extends('master')

@section('title')
	Ubah Password
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
			<form method="POST" action="/users/updatepassword">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="email">Email</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('email') ? 'form-error' : '' }}" id="email" name="email" type="text"
							value="{{ old('email') }}" placeholder="Masukan Email">
					</div>
				</div>
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
