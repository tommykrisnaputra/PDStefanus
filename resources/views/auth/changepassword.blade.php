@extends('master')

@section('title')
    Change Password
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
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
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukan Email" class="{{ $errors->has('email') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75 password-container">
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                            placeholder="Masukan Password" class="{{ $errors->has('password') ? 'form-error' : '' }}">
                        <i class="far fa-eye" id="eye"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password">Konfirmasi Password</label>
                    </div>
                    <div class="col-75 password-container">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            value="{{ old('password_confirmation') }}" placeholder="Masukan ulang Password"
                            class="{{ $errors->has('password') ? 'form-error' : '' }}">
                        <i class="far fa-eye" id="eye-confirmation"></i>
                    </div>
                </div>
                <div class="row submit-button-container">
                    <input type="submit" value="Submit" class="submit-button">
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
