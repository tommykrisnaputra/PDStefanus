@extends('master')

@section('title')
    Tema PD
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/events/index.css') }}">
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
                <div class="buttons">
                    <a href="{{ route('temapd.add') }}">
                        <button class="action-button">
                            <span>Tambah Tema PD</span>
                        </button>
                    </a>
                </div>
            </div>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-4">Nama</div>
                    <div class="col col-4">Tanggal Kegiatan</div>
                    <div class="col col-2">Active</div>
                    <div class="col col-4">Deskripsi</div>
                    <div class="col col-1"></div>
                </li>
                @foreach ($TemaPd as $key => $data)
                    <li class="table-row">
                        <div class="col col-4" data-label="Nama">{{ $data->title ?? null }}</div>
                        <div class="col col-4" data-label="Tanggal Kegiatan">
                            {{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Active">{{ $data->active ?? null }}</div>
                        <div class="col col-4" data-label="Deskripsi">{{ $data->description ?? null }}</div>
                        <div class="col col-1" data-label="Action">
                            <a href="{{ url("temapd/edit/$data->id") }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a>
                        </div>
                    </li>
                @endforeach
                {{ $TemaPd->appends($_POST)->links() }}
            </ul>
        </div>
    </div>
@endsection

@section('js')
@endsection
