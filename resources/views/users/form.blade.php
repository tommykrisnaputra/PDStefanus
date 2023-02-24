@extends('master')

@section('title')
    Pendaftaran
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/users/form.css') }}">
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
            <form method="POST" action="/users/update/{{ $users->id }}">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="fullname">Nama Lengkap</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fullname" name="fullname"
                            value="{{ old('fullname', $users->full_name ?? '') }}" placeholder="Masukan nama"
                            class="{{ $errors->has('fullname') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" value="{{ old('email', $users->email ?? '') }}"
                            placeholder="Masukan email" class="{{ $errors->has('email') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="phone_number">Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="tel" id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $users->phone_number ?? '') }}" placeholder="Masukan nomor HP"
                            class="{{ $errors->has('phone_number') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="birthdate">Tanggal Lahir</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="birthdate" name="birthdate"
                            value="{{ date('Y-m-d', strtotime(old('birthdate', $users->birthdate ?? ''))) }}"
                            placeholder="Masukan tanggal lahir"
                            class="{{ $errors->has('birthdate') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address"
                            value="{{ old('address', $users->address ?? '') }}" placeholder="Masukan alamat"
                            class="{{ $errors->has('address') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="paroki">Paroki</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="paroki" name="paroki"
                            value="{{ old('paroki', $users->paroki ?? '') }}" placeholder="Masukan paroki"
                            class="{{ $errors->has('paroki') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="social_instagram">Instagram</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="social_instagram" name="social_instagram"
                            value="{{ old('social_instagram', $users->social_instagram ?? '') }}"
                            placeholder="Masukan tag Instagram"
                            class="{{ $errors->has('social_instagram') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-75">
                        <select name="gender" id="gender" value="male"
                            value="{{ old('gender', $users->gender ?? '') }}" placeholder="Masukan gender"
                            class="{{ $errors->has('gender') ? 'form-error' : '' }}">
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
                        <input type="date" id="first_attendance" name="first_attendance"
                            value="{{ date('Y-m-d', strtotime(old('first_attendance', $users->first_attendance ?? ''))) }}"
                            placeholder="Masukan tanggal kedatangan pertama kali"
                            class="{{ $errors->has('first_attendance') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="last_attendance">Terakhir Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="last_attendance" name="last_attendance"
                            value="{{ date('Y-m-d', strtotime(old('last_attendance', $users->last_attendance ?? ''))) }}"
                            placeholder="Masukan tanggal kedatangan terakhir"
                            class="{{ $errors->has('last_attendance') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="total_attendance">Total Kedatangan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="total_attendance" name="total_attendance"
                            value="{{ old('total_attendance', $users->total_attendance ?? '') }}"
                            placeholder="Masukan total kedatangan"
                            class="{{ $errors->has('total_attendance') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="attendance_percentage">Persentase Kedatangan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="attendance_percentage" name="attendance_percentage"
                            value="{{ old('attendance_percentage', $users->attendance_percentage ?? '') }}"
                            placeholder="Masukan persentase kedatangan"
                            class="{{ $errors->has('attendance_percentage') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="description">Deskripsi</label>
                    </div>
                    <div class="col-75">
                        <textarea id="description" name="description" style="height:200px"
                            value="{{ old('description', $users->description ?? '') }}"></textarea>
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
