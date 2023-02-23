@extends('master')

@section('title')
    Umat PD
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <div class="bg-light p-5 rounded">
                @auth
                    <h1>Dashboard</h1>
                    <p class="lead">Only authenticated users can access this section.</p>
                    <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here
                        &raquo;</a>
                @endauth

                @guest
                    <h1>Homepage</h1>
                    <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
                @endguest
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
