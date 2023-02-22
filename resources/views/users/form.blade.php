@extends('master')

@section('title')
    Umat PD
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/users/form.css') }}">
@endsection

@section('navbar')
    @parent
    @if (session('message'))
        <div class="toast active">
            <div class="toast-content">
                <div class="message">
                    <span class="text text-1">Success!</span>
                    {{ session('message') }}
                </div>
            </div>
            <div class="progress active"></div>
        </div>
    @endif
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <form method="POST" action="/users/update/{{ $users->id }}">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="fullname">Nama Lengkap</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fullname" name="fullname" value="{{ $users->full_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="birthdate">Tanggal Lahir</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="birthdate" name="birthdate" value="{{ $users->birthdate }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" value="{{ $users->address }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="paroki">Paroki</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="paroki" name="paroki" value="{{ $users->paroki }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="social_instagram">Instagram</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="social_instagram" name="social_instagram"
                            value="{{ $users->social_instagram }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="social_tiktok">Tik Tok</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="social_tiktok" name="social_tiktok" value="{{ $users->social_tiktok }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="phone_number">Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="phone_number" name="phone_number" value="{{ $users->phone_number }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="email" name="email" value="{{ $users->email }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="gender" name="gender" value="{{ $users->gender }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="first_attendance">Pertama Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="first_attendance" name="first_attendance"
                            value="{{ $users->first_attendance }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="last_attendance">Terakhir Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="last_attendance" name="last_attendance"
                            value="{{ $users->last_attendance }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="total_attendance">Total Kedatangan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="total_attendance" name="total_attendance"
                            value="{{ $users->total_attendance }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="attendance_percentage">Persentase Kedatangan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="attendance_percentage" name="attendance_percentage"
                            value="{{ $users->attendance_percentage }}"">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="description">Deskripsi</label>
                    </div>
                    <div class="col-75">
                        <textarea id="description" name="description" style="height:200px" value="{{ $users->description }}"></textarea>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $("document").ready(function() {
            setTimeout(function() {
                $('.toast').remove();
            }, 2000);
        });
    </script>
@endsection
