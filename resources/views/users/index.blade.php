@extends('master')

@section('title')
    Umat PD
@endsection

@section('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @parent
    <link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance/search.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <form method="post" action={{ route('users.export') }}>
                @csrf
                <div class="search-button mb20 btn-group">
                    <button class="btn btn-primary col col-md-3" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Advanced Search
                    </button>

                    <input type="hidden" name="full_name" value="{{ $data->full_name }}">
                    <input type="hidden" name="phone" value="{{ $data->phone }}">
                    <input type="hidden" name="paroki" value="{{ $data->paroki }}">
                    <input type="hidden" name="wilayah" value="{{ $data->wilayah }}">
                    <input type="hidden" name="email" value="{{ $data->email }}">
                    <input type="hidden" name="role" value="{{ $data->role }}">
                    <input type="hidden" name="date_from" value="{{ $data->date_from }}">
                    <input type="hidden" name="date_to" value="{{ $data->date_to }}">
                    <input type="hidden" name="fa_from" value="{{ $data->fa_from }}">
                    <input type="hidden" name="fa_to" value="{{ $data->fa_to }}">
                    <input type="hidden" name="day_from" value="{{ $data->day_from }}">
                    <input type="hidden" name="day_to" value="{{ $data->day_to }}">
                    <input type="hidden" name="total_op" value="{{ $data->total_op }}">
                    <input type="hidden" name="percentage_op" value="{{ $data->percentage_op }}">

                    <button class="btn btn-info col col-md-3" type="submit">
                        Download Excel
                    </button>
                </div>
            </form>
            <div class="collapse card card-6 search-main-container mb20" id="collapseExample">
                <div class="card-body">
                    <form method="POST" action={{ route('users.search') }}>
                        @csrf
                        <!-- {{ csrf_field() }} -->
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
                                    <label class="label">Paroki</label>
                                    <input class="input--style-1" type="text" name="paroki"
                                        placeholder="Masukkan paroki" value="{{ $data->paroki ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Wilayah</label>
                                    <input class="input--style-1" type="text" name="wilayah"
                                        placeholder="Masukkan wilayah" value="{{ $data->wilayah ?? null }}">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-1" type="email" name="email"
                                        placeholder="Masukkan email" value="{{ $data->email ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Roles</label>
                                    <select name="role" class="input--style-1 width-100">
                                        @foreach ($data->roles as $item => $value)
                                            <option value="{{ $item }}" @selected($item == $data->role)>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                        </div>
                        <div class="row row-space">
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang (from)</label>
                                    <input class="input--style-1" type="date" name="fa_from"
                                        placeholder="DD MMM YYYY" id="fa_from" value="{{ $data->fa_from ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang (to)</label>
                                    <input class="input--style-1" type="date" name="fa_to"
                                        placeholder="DD MMM YYYY" id="fa_to" value="{{ $data->fa_to ?? null }}">
                                </div>
                            </div>
                            <div class="search-op">
                                <div class="input-group">
                                    <label class="label">Tanggal Lahir (from)</label>
                                    <select name="day_from" class="input--style-2 operator">
                                        @foreach ($data->days as $item)
                                            <option value="{{ $item }}" @selected($item == $data->day_from)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="month_from" class="input--style-2">
                                        @foreach ($data->months as $item)
                                            <option value="{{ $item }}" @selected($item == $data->month_from)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="search-op">
                                <div class="input-group">
                                    <label class="label">Tanggal Lahir (to)</label>
                                    <select name="day_to" class="input--style-2 operator">
                                        @foreach ($data->days as $item)
                                            <option value="{{ $item }}" @selected($item == $data->day_to)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="month_to" class="input--style-2">
                                        @foreach ($data->months as $item)
                                            <option value="{{ $item }}" @selected($item == $data->month_to)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="search-op">
                                <div class="input-group">
                                    <label class="label">Total Kedatangan</label>
                                    <select name="total_op" class="input--style-2 operator">
                                        @foreach ($data->operators as $item)
                                            <option value="{{ $item }}" @selected($item == $data->total_op)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="input--style-3" type="tel" name="total_attendance"
                                        placeholder="Masukkan total kedatangan"
                                        value="{{ $data->total_attendance ?? null }}">
                                </div>
                            </div>
                            <div class="search-op">
                                <div class="input-group">
                                    <label class="label">Kedatangan (%)</label>
                                    <select name="percentage_op" class="input--style-2 operator">
                                        @foreach ($data->operators as $item)
                                            <option value="{{ $item }}" @selected($item == $data->percentage_op)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="input--style-3" type="tel" name="attendance_percentage"
                                        placeholder="Masukkan persentase"
                                        value="{{ $data->attendance_percentage ?? null }}">
                                </div>
                            </div>
                            <div class="search-4">
                            </div>
                            <div class="search-4">
                                <div class="input-group">
                                    <button class="btn-submit m-b-0 mt40" type="submit">search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col table-2">Nama</div>
                    <div class="col table-2">Tanggal Lahir</div>
                    <div class="col table-2">Wilayah</div>
                    <div class="col table-1">Nomor HP</div>
                    <div class="col table-1">Instagram</div>
                    <div class="col table-1">Terakhir Datang</div>
                    <div class="col table-1">Persentase Kedatangan</div>
                    <div class="col table-1"></div>
                </li>
                @foreach ($users as $key => $data)
                    <li class="table-row">
                        <div class="col table-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
                        <div class="col table-2" data-label="Tanggal Lahir">
                            {{ Carbon\Carbon::parse($data->birthdate)->format('d M Y') ?? null }}</div>
                        <div class="col table-2" data-label="Wilayah">{{ $data->wilayah ?? null }}</div>
                        <div class="col table-1" data-label="Nomor HP">
                            <a href="https://wa.me/{{ $data->phone }}">
                                {{ $data->phone ?? null }}
                            </a>
                        </div>
                        <div class="col table-1" data-label="Instagram">
                            <a href="https://www.instagram.com/{{ $data->social_instagram }}">
                                {{ $data->social_instagram ?? null }}
                            </a>
                        </div>
                        <div class="col table-1" data-label="Terakhir Datang">
                            {{ Carbon\Carbon::parse($data->last_attendance)->format('d M Y') ?? null }}</div>
                        <div class="col table-1" data-label="Persentase Kehadiran">
                            {{ $data->attendance_percentage ?? null }}%
                        </div>
                        <div class="col table-1" data-label="Action">
                            <a href="{{ url("users/edit/$data->id") }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a>
                        </div>
                    </li>
                @endforeach
                {{ $users->appends($_POST)->links() }}
            </ul>
        </div>
    </div>
@endsection

@section('js')
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
