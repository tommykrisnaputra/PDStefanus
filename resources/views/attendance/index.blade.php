@extends('master')

@section('title')
    Kehadiran
@endsection

@section('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            <form method="post" action={{ route('attendance.export') }}>
                @csrf
                <div class="search-button mb20 btn-group">
                    <button class="btn btn-primary col col-md-3" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Advanced Search
                    </button>

                    <input type="hidden" name="date_from" value="{{ $data->date_from }}">
                    <input type="hidden" name="date_to" value="{{ $data->date_to }}">
                    <input type="hidden" name="fa_from" value="{{ $data->fa_from }}">
                    <input type="hidden" name="fa_to" value="{{ $data->fa_to }}">
                    <input type="hidden" name="full_name" value="{{ $data->full_name }}">
                    <input type="hidden" name="phone" value="{{ $data->phone }}">
                    <input type="hidden" name="wilayah" value="{{ $data->wilayah }}">

                    <button class="btn btn-info col col-md-3" type="submit" name="action" value="download">
                        Download Excel
                    </button>
                </div>
            </form>
            <div class="collapse card card-6 search-main-container mb20" id="collapseExample">
                <div class="card-body">
                    <form method="POST" action={{ route('attendance.index') }}>
                        @csrf
                        <!-- {{ csrf_field() }} -->
                        <div class="row row-space">
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Kehadiran (from)</label>
                                    <input class="input--style-1" type="date" name="date_from" id="date_from"
                                        value="{{ $data->date_from ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Kehadiran (to)</label>
                                    <input class="input--style-1" type="date" name="date_to" id="date_to"
                                        value="{{ $data->date_to ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang (from)</label>
                                    <input class="input--style-1" type="date" name="fa_from" placeholder="DD MMM YYYY"
                                        id="fa_from" value="{{ $data->fa_from ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang (to)</label>
                                    <input class="input--style-1" type="date" name="fa_to" placeholder="DD MMM YYYY"
                                        id="fa_to" value="{{ $data->fa_to ?? null }}">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Nama Umat</label>
                                    <input class="input--style-1" type="text" name="full_name"
                                        placeholder="Masukkan nama umat" value="{{ $data->full_name ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Nomor HP</label>
                                    <input class="input--style-1" type="tel" name="phone"
                                        placeholder="Masukkan nomor HP" value="{{ $data->phone ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Wilayah</label>
                                    <input class="input--style-1" type="text" name="wilayah"
                                        placeholder="Masukkan wilayah" value="{{ $data->wilayah ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <button class="btn-submit m-b-0 mt20" type="submit" name="action"
                                        value="search">search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col table-2">Nama Umat</div>
                    <div class="col table-2">Nomor HP</div>
                    <div class="col table-2">Tanggal Kehadiran</div>
                    <div class="col table-2">Pertama Datang</div>
                    <div class="col table-2">Total Kehadiran</div>
                    <div class="col table-2">Persentase Kehadiran</div>
                    {{-- <div class="col table-2"></div> --}}
                </li>

                @foreach ($attendance as $key => $data)
                    <li class="table-row">
                        <div class="col table-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
                        <div class="col table-2" data-label="Nomor HP">
                            <a href="https://wa.me/{{ $data->phone }}">
                                {{ $data->phone ?? null }}
                            </a>
                        </div>
                        <div class="col table-2" data-label="Tanggal Kehadiran">
                            {{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
                        <div class="col table-2" data-label="Pertama Datang">
                            {{ Carbon\Carbon::parse($data->first_attendance)->format('d M Y') ?? null }}</div>
                        <div class="col table-2" data-label="Total Kehadiran">{{ $data->total_attendance ?? null }}
                        </div>
                        <div class="col table-2" data-label="Persentase Kehadiran">
                            {{ $data->attendance_percentage ?? null }}%
                        </div>
                        {{-- <a href="{{ url("users/edit/$data->id") }}" class="solid-button-container">
                            <button class="solid-button-button button Button">Detail</button>
                        </a> --}}
                        {{-- </div> --}}
                        </a>
                    </li>
                @endforeach
                {{ $attendance->appends($_POST)->links() }}
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
@endsection
