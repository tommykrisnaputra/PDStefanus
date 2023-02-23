@extends('master')

@section('title')
    Pendaftaran
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
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                        <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="phone_number">Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="birthdate">Tanggal Lahir</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" value="{{ old('address') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="paroki">Paroki</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="paroki" name="paroki" value="{{ old('paroki') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-75">
                        <select name="gender" id="gender" value="male" value="{{ old('gender') }}">
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
                        <input type="date" id="first_attendance" name="first_attendance" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="password" name="password" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password">Konfirmasi Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="password" name="password_confirmation"
                            value="{{ old('password_confirmation') }}">
                    </div>
                </div>
                <div class="row
                                                    submit-button-container">
                    <input type="submit" value="Submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
