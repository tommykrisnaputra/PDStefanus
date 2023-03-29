@extends('master')

@section('title')
    Data Kehadiran
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/attendance/index.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <div class="search-main-container">
                <div class="search-text">
                    <div class="search-container">
                        <input type="text" name="search" placeholder="Search..." class="search-input" id="search">
                        <a href="#" class="search-btn">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">Nama</div>
                    <div class="col col-1">Event</div>
                    <div class="col col-1">Tanggal</div>
                    <div class="col col-1"></div>
                </li>
                {{-- <div class="table-rows">
                </div> --}}
                <li class="table-row">
                    <div class="col col-1" data-label="Nama">42235</div>
                    <div class="col col-1" data-label="Event">John Doe</div>
                    <div class="col col-1" data-label="Tanggal">$350</div>
                    <div class="col col-1" data-label="Action">
                        <a href="{{ url('events/edit/`+res.events[i].id+`') }}" class="solid-button-container">
                            <button class="solid-button-button button Button">Edit</button>
                        </a>
                    </div>
                    </a>
                </li>
                <li class="table-row">
                    <div class="col col-1" data-label="Nama">42235</div>
                    <div class="col col-1" data-label="Event">John Doe</div>
                    <div class="col col-1" data-label="Tanggal">$350</div>
                    <div class="col col-1" data-label="Action">
                        <a href="{{ url('events/edit/`+res.events[i].id+`') }}" class="solid-button-container">
                            <button class="solid-button-button button Button">Edit</button>
                        </a>
                    </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('js')
@endsection
