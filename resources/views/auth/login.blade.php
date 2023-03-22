@extends('master')

@section('title')
    Login
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
        <div class="container">
            <form method="POST" action="/login">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="username">Email atau Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="username" id="username" name="username" value="{{ old('username') }}"
                            placeholder="Masukan Email atau Nomor HP" class="{{ $errors->has('username') ? 'form-error' : '' }}">
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
                <div class="row submit-button-container">
                    <input type="submit" value="Submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
