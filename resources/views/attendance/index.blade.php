@extends('master')

@section('title')
    Data Kehadiran
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/attendance/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance/search.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <div class="card card-6 search-main-container">
                <div class="card-body">
                    <form method="POST" action="#">
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Nama Umat</label>
                                    <input class="input--style-1" type="text" name="full_name"
                                        placeholder="Masukkan nama umat">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-1" type="email" name="email"
                                        placeholder="Masukkan email">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Nomor HP</label>
                                    <input class="input--style-1" type="text" name="phone"
                                        placeholder="Masukkan nomor HP">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Wilayah</label>
                                    <input class="input--style-1" type="text" name="wilayah"
                                        placeholder="Masukkan wilayah">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Keadatangan Terakhir</label>
                                    <input class="input--style-1" type="text" name="la-start" placeholder="DD MMM YYYY"
                                        id="la-start">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Return</label>
                                    <input class="input--style-1" type="text" name="la-end" placeholder="DD MMM YYYY"
                                        id="la-end">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Paroki</label>
                                    <input class="input--style-1" type="text" name="paroki"
                                        placeholder="Masukkan paroki">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Alamat</label>
                                    <input class="input--style-1" type="text" name="address"
                                        placeholder="Masukkan alamat">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Event</label>
                                    <input class="input--style-1" type="text" name="event"
                                        placeholder="Pilih kegiatan">
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn-submit m-b-0" type="submit">search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="search-text"> --}}
            {{-- <div class="search-container">
                        <input type="text" name="search" placeholder="Search..." class="search-input"
                            id="search">
                        <a href="#" class="search-btn">
                            <i class="fas fa-search"></i>
                        </a>
                    </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-2">Nama Umat</div>
                    {{-- <div class="col col-2">Kegiatan</div> --}}
                    <div class="col col-2">Pertama Datang</div>
                    <div class="col col-2">Tanggal Kehadiran</div>
                    <div class="col col-2"></div>
                </li>

                @foreach ($attendance as $key => $data)
                    <li class="table-row">
                        <div class="col col-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
                        {{-- <div class="col col-2" data-label="Kegiatan">{{ $data->title ?? null }}</div> --}}
                        <div class="col col-2" data-label="Pertama Datang">
                            {{ Carbon\Carbon::parse($data->first_attendance)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Tanggal Kehadiran">
                            {{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
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
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/jquery-validate/jquery.validate.min.js"></script>
    <script src="vendor/bootstrap-wizard/bootstrap.min.js"></script>
    <script src="vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
@endsection
