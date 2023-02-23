@extends('master')

@section('title')
    Pendaftaran
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
            <form method="POST" action="/register">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="fullname">Nama Lengkap</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}"
                            placeholder="Masukan nama" class="{{ $errors->has('fullname') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukan email" class="{{ $errors->has('email') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="phone_number">Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                            placeholder="Masukan nomor HP" class="{{ $errors->has('phone_number') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="birthdate">Tanggal Lahir</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}"
                            placeholder="Masukan tanggal lahir"
                            class="{{ $errors->has('birthdate') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            placeholder="Masukan alamat" class="{{ $errors->has('address') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="paroki">Paroki</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="paroki" name="paroki" value="{{ old('paroki') }}"
                            placeholder="Masukan paroki" class="{{ $errors->has('paroki') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-75">
                        <select name="gender" id="gender" value="male" value="{{ old('gender') }}"
                            placeholder="Masukan gender" class="{{ $errors->has('gender') ? 'form-error' : '' }}">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="first_attendance">Pertama Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="first_attendance" name="first_attendance" value="<?php echo date('Y-m-d'); ?>"
                            placeholder="Masukan tanggal kedatangan pertama kali"
                            class="{{ $errors->has('first_attendance') ? 'form-error' : '' }}">
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
