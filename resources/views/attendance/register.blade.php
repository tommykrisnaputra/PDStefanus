@extends('master')

@section('title')
    Kehadiran
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
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
            <form method="POST" action="/attendance">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email atau Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukan Email atau nomor HP"
                            class="{{ $errors->has('email') ? 'form-error' : '' }}">
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-25">
                        <label for="date">Tanggal</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>"
                            placeholder="Masukan tanggal" class="{{ $errors->has('date') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
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
