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
            <form method="POST" action="/users/update/{{ $users->id }}">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="username">Email atau Nomor HP</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="username" name="username">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="password" name="password">
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
@endsection
