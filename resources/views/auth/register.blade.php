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
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="/register">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="fullname">Nama Lengkap</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fullname" name="fullname"
                            class="@error('fullname') is-invalid @enderror">
                    </div>
                </div>
                {{-- @error('fullname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror">
                    </div>
                </div>
                {{-- @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
                <div class="row">
                    <div class="col-25">
                        <label for="phone_number">Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="tel" id="phone_number" name="phone_number"
                            class="@error('phone_number') is-invalid @enderror">
                    </div>
                </div>
                {{-- @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
                <div class="row">
                    <div class="col-25">
                        <label for="birthdate">Tanggal Lahir</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="birthdate" name="birthdate"
                            class="@error('birthdate') is-invalid @enderror">
                    </div>
                </div>
                @error('birthdate')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" class="@error('address') is-invalid @enderror">
                    </div>
                </div>
                @error('birthdate')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-25">
                        <label for="paroki">Paroki</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="paroki" name="paroki" class="@error('paroki') is-invalid @enderror">
                    </div>
                </div>
                @error('paroki')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- <div class="row">
                    <div class="col-25">
                        <label for="social_instagram">Instagram</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="social_instagram" name="social_instagram"
                            class="@error('social_instagram') is-invalid @enderror">
                    </div>
                </div>
                @error('social_instagram')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
                {{-- <div class="row">
                    <div class="col-25">
                        <label for="social_tiktok">Tik Tok</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="social_tiktok" name="social_tiktok">
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-25">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="gender" name="gender" class="@error('gender') is-invalid @enderror">
                    </div>
                </div>
                @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-25">
                        <label for="first_attendance">Pertama Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="first_attendance" name="first_attendance"
                            class="@error('first_attendance') is-invalid @enderror">
                    </div>
                </div>
                @error('first_attendance')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="password" name="password"
                            class="@error('password') is-invalid @enderror">
                    </div>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-25">
                        <label for="confirm_password">Konfirmasi Password</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="confirm_password" name="confirm_password"
                            class="@error('confirm_password') is-invalid @enderror">
                    </div>
                </div>
                {{-- @error('confirm_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
                <div class="row submit-button-container">
                    <input type="submit" value="Submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
