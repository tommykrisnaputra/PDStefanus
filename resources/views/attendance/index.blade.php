@extends('master')

@section('title')
    Kehadiran
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <div class="card card-6 search-main-container">
                <div class="card-body">
                    <form method="POST" action={{ route('attendance.index') }}>
                        @csrf
                        <!-- {{ csrf_field() }} -->
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Nama Umat</label>
                                    <input class="input--style-1" type="text" name="full_name"
                                        placeholder="Masukkan nama umat" value="{{ $data->full_name ?? null }}">
                                </div>
                            </div>
                            {{-- <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Paroki</label>
                                    <input class="input--style-1" type="text" name="paroki"
                                        placeholder="Masukkan paroki" value="{{ $data->paroki ?? null }}">
                                </div>
                            </div> --}}
                            {{-- <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-1" type="email" name="email" placeholder="Masukkan email"
                                        value="{{ $data->email ?? null }}">
                                </div>
                            </div> --}}
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Nomor HP</label>
                                    <input class="input--style-1" type="tel" name="phone"
                                        placeholder="Masukkan nomor HP" value="{{ $data->phone ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Wilayah</label>
                                    <input class="input--style-1" type="text" name="wilayah"
                                        placeholder="Masukkan wilayah" value="{{ $data->wilayah ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                {{-- <div class="input-group">
                                    <label class="label">Alamat</label>
                                    <input class="input--style-1" type="text" name="address"
                                        placeholder="Masukkan alamat" value="{{ $data->address ?? null }}">
                                </div> --}}
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Kehadiran (from)</label>
                                    <input class="input--style-1" type="date" name="date_from" id="date-from"
                                        value="{{ $data->date_from ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Kehadiran (to)</label>
                                    <input class="input--style-1" type="date" name="date_to" id="date-to"
                                        value="{{ $data->date_to ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang</label>
                                    <input class="input--style-1" type="date" name="first_attendance"
                                        placeholder="DD MMM YYYY" id="first_attendance"
                                        value="{{ $data->first_attendance ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn-submit m-b-0" type="submit">search</button>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                {{-- <div class="input-group">
                                    <label class="label">Event</label>
                                    <input class="input--style-1" type="text" name="event"
                                        placeholder="Pilih kegiatan">
                                </div> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-2">Nama Umat</div>
                    <div class="col col-2">Nomor HP</div>
                    <div class="col col-2">Tanggal Kehadiran</div>
                    <div class="col col-2">Pertama Datang</div>
                    <div class="col col-2">Total Kehadiran</div>
                    <div class="col col-2">Persentase Kehadiran</div>
                    <div class="col col-2"></div>
                </li>

                @foreach ($attendance as $key => $data)
                    <li class="table-row">
                        <div class="col col-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
                        <div class="col col-2" data-label="Nomor HP">
                            <a href="https://wa.me/{{ $data->phone }}">
                                {{ $data->phone ?? null }}
                            </a>
                        </div>
                        <div class="col col-2" data-label="Tanggal Kehadiran">
                            {{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Pertama Datang">
                            {{ Carbon\Carbon::parse($data->first_attendance)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Total Kehadiran">{{ $data->total_attendance ?? null }}</div>
                        <div class="col col-2" data-label="Persentase Kehadiran">
                            {{ $data->attendance_percentage ?? null }}%
                        </div>
                        <div class="col col-2" data-label="Action">
                            <a href="{{ url("users/edit/$data->user_id") }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Details</button>
                            </a>
                            {{-- <a href="{{ url('attendance/edit/`+res.events[i].id+`') }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a> --}}
                        </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $('.daterange').daterangepicker({
            startDate: moment().day(-3),
            endDate: moment().day(4),
            locale: {
                format: 'DD MMM YYYY'
            }
        });
    </script>
@endsection
