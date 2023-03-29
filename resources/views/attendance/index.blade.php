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
                    <div class="col col-2">Nama</div>
                    {{-- <div class="col col-2">Kegiatan</div> --}}
                    <div class="col col-2">Pertama Datang</div>
                    <div class="col col-2">Tanggal Kehadiran</div>
                    <div class="col col-2"></div>
                </li>

                @foreach ($attendance as $key => $data)
                    <li class="table-row">
                        <div class="col col-2" data-label="Nama">{{ $data->full_name ?? null }}</div>
                        {{-- <div class="col col-2" data-label="Kegiatan">{{ $data->title ?? null }}</div> --}}
                        <div class="col col-2" data-label="Pertama Datang">{{ Carbon\Carbon::parse($data->first_attendance)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Tanggal Kehadiran">{{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Action">
                            <a href="{{ url('attendance/edit/`+res.events[i].id+`') }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a>
                        </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('js')
@endsection
