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
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-2">Nama</div>
                    <div class="col col-3">Tanggal Lahir</div>
                    <div class="col col-1">Alamat</div>
                    <div class="col col-2">Paroki</div>
                    <div class="col col-2">Nomor HP</div>
                    <div class="col col-3">Kedatangan Terakhir</div>
                    <div class="col col-3">Persentase Kedatangan</div>
                    <div class="col col-3"></div>
                </li>
                @foreach ($users as $key => $data)
                    <li class="table-row">
                        <div class="col col-2" data-label="Nama">{{ $data->full_name }}</div>
                        <div class="col col-3" data-label="Tanggal Lahir">
                            {{ date('d-m-Y', strtotime($data->birthdate)) }}</div>
                        <div class="col col-1" data-label="Alamat">{{ $data->address }}</div>
                        <div class="col col-2" data-label="Paroki">{{ $data->paroki }}</div>
                        <div class="col col-2" data-label="Nomor HP">{{ $data->phone_number }}</div>
                        <div class="col col-3" data-label="Kedatangan Terakhir">
                            {{ date('D,d-m-Y', strtotime($data->last_attendance)) }}</div>
                        <div class="col col-3" data-label="Persentase Kedatangan">
                            {{ $data->attendance_percentage }}%</div>
                        <div class="col col-3" data-label="Action">
                            <a href="{{ url('users/edit', ['id' => $data->id]) }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
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
