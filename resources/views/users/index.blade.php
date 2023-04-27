@extends('master')

@section('title')
    Umat PD
@endsection

@section('css')
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
            <div class="card card-6 search-main-container">
                <div class="card-body">
                    <form method="POST" action={{ route('users.search') }}>
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
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Nomor HP</label>
                                    <input class="input--style-1" type="tel" name="phone"
                                        placeholder="Masukkan nomor HP" value="{{ $data->phone ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Paroki</label>
                                    <input class="input--style-1" type="text" name="paroki"
                                        placeholder="Masukkan paroki" value="{{ $data->paroki ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Wilayah</label>
                                    <input class="input--style-1" type="text" name="wilayah"
                                        placeholder="Masukkan wilayah" value="{{ $data->wilayah ?? null }}">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Kehadiran (from)</label>
                                    <input class="input--style-1" type="date" name="date_from" id="date_from"
                                        value="{{ $data->date_from ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Kehadiran (to)</label>
                                    <input class="input--style-1" type="date" name="date_to" id="date_to"
                                        value="{{ $data->date_to ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang (from)</label>
                                    <input class="input--style-1" type="date" name="fa_from"
                                        placeholder="DD MMM YYYY" id="fa_from"
                                        value="{{ $data->fa_from ?? null }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Pertama Datang (to)</label>
                                    <input class="input--style-1" type="date" name="fa_to"
                                        placeholder="DD MMM YYYY" id="fa_to"
                                        value="{{ $data->fa_to ?? null }}">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-op">
                                <div class="input-group">
                                    <label class="label">Total</label>
                                    <select name="total_op" class="input--style-1 operator">
                                        @foreach ($data->operators as $item)
                                            <option value="{{ $item }}" @selected($item == $data->total_op)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group width-100">
                                    <label class="label">Kedatangan</label>
                                    <input class="input--style-1" type="tel" name="total_attendance"
                                        placeholder="Masukkan total kedatangan"
                                        value="{{ $data->total_attendance ?? null }}">
                                </div>
                            </div>
                            <div class="col-op">
                                <div class="input-group">
                                    <label class="label">Persentase</label>
                                    <select name="percentage_op" class="input--style-1 operator">
                                        @foreach ($data->operators as $item)
                                            <option value="{{ $item }}" @selected($item == $data->percentage_op)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group width-100">
                                    <label class="label">Kedatangan</label>
                                    <input class="input--style-1" type="tel" name="attendance_percentage"
                                        placeholder="Masukkan persentase"
                                        value="{{ $data->attendance_percentage ?? null }}">
                                </div>
                            </div>

                            {{-- <div class="col-op">
                                <div class="input-group">
                                    <label class="label">Tanggal</label>
                                    <select name="day_from" class="input--style-1 operator">
                                        @foreach ($data->operators as $item)
                                            <option value="{{ $item }}" @selected($item == $data->total_op)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group width-100">
                                    <label class="label">Lahir (from)</label>
                                    <select name="day_from" class="input--style-1 operator">
                                        @foreach ($data->operators as $item)
                                            <option value="{{ $item }}" @selected($item == $data->total_op)>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <button class="btn-submit m-b-0" type="submit">search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-2">Nama</div>
                    <div class="col col-2">Tanggal Lahir</div>
                    <div class="col col-2">Wilayah</div>
                    <div class="col col-2">Nomor HP</div>
                    <div class="col col-3">Instagram</div>
                    {{-- <div class="col col-2">Tik Tok</div> --}}
                    <div class="col col-2">Terakhir Datang</div>
                    <div class="col col-1">Persentase Kedatangan</div>
                    <div class="col col-1"></div>
                </li>
                @foreach ($users as $key => $data)
                    <li class="table-row">
                        <div class="col col-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
                        <div class="col col-2" data-label="Tanggal Lahir">
                            {{ Carbon\Carbon::parse($data->birthdate)->format('d M Y') ?? null }}</div>
                        <div class="col col-2" data-label="Wilayah">{{ $data->wilayah ?? null }}</div>
                        <div class="col col-2" data-label="Nomor HP">
                            <a href="https://wa.me/{{ $data->phone }}">
                                {{ $data->phone ?? null }}
                            </a>
                        </div>
                        <div class="col col-3" data-label="Instagram">
                            <a href="https://www.instagram.com/{{ $data->social_instagram }}">
                                {{ $data->social_instagram ?? null }}
                            </a>
                        </div>
                        {{-- <div class="col col-2" data-label="Tik Tok">
                            <a href="https://www.tiktok.com/@{{ $data - > social_tiktok }}">
                                {{ $data->social_tiktok ?? null }}
                            </a>
                        </div> --}}
                        <div class="col col-2" data-label="Terakhir Datang">
                            {{ Carbon\Carbon::parse($data->last_attendance)->format('d M Y') ?? null }}</div>

                        <div class="col col-1" data-label="Persentase Kehadiran">
                            {{ $data->attendance_percentage ?? null }}%
                        </div>
                        <div class="col col-1" data-label="Action">
                            <a href="{{ url("users/edit/$data->id") }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a>
                        </div>
                    </li>
                @endforeach
                <div class="table-rows">
                </div>
            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#search').on('keyup', function() {
            search();
        });
        search();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function search() {
            var keyword = $('#search').val();
            $.post('{{ route('users.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                });
        }
        // table row with ajax
        function table_post_row(res) {
            let options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            let options_2 = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            function toLocal(date) {
                var local = new Date(date);
                local.setMinutes(date.getMinutes() - date.getTimezoneOffset());
                return local.toJSON();
            }
            let htmlView = '';
            //         if (res.users.length <= 0) {
            //             htmlView += `
        //    <tr>
        //       <td colspan="4">No data.</td>
        //   </tr>`;
            //         }
            for (let i = 0; i < res.users.length; i++) {
                htmlView += `
                        <li class="table-row">
                            <div class="col col-1" data-label="Nama"> ` + res.users[i].full_name + ` </div>
                            <div class="col col-2" data-label="Tanggal Lahir">
                                ` + new Date(res.users[i].birthdate).toLocaleString('id-ID', options_2) + `</div>
                            <div class="col col-2" data-label="Wilayah">` + res.users[i].wilayah + ` </div>
                            <div class="col col-2" data-label="Nomor HP"> <a href="https://wa.me/` + res
                    .users[i].phone + `" target="_blank" rel="noreferrer noopener">` + res.users[i].phone + `</a> </div>
                            <div class="col col-1" data-label="Instagram"> <a href="https://www.instagram.com/` + res
                    .users[i].social_instagram + `" target="_blank" rel="noreferrer noopener">` +
                    res.users[i].social_instagram + `</a> </div>
                            <div class="col col-1" data-label="Tik Tok"> <a href="https://www.tiktok.com/@` + res
                    .users[i].social_tiktok + `" target="_blank" rel="noreferrer noopener">` + res.users[i].social_tiktok + `</a> </div>
                            <div class="col col-2" data-label="Kedatangan Terakhir">
                                ` + new Date(res.users[i].last_attendance).toLocaleString('id-ID', options_2) + `
                                </div>
                            <div class="col col-1" data-label="Persentase Kedatangan">
                                 ` + res.users[i].attendance_percentage + `%</div>
                            <div class="col col-1" data-label="Action">
                                <a href="{{ url('users/edit/`+res.users[i].id+`') }}" class="solid-button-container">
                                    <button class="solid-button-button button Button">Edit</button>
                                </a>
                            </div>
                        </li>
                `;
            }
            $('.table-rows').html(htmlView);
        }
    </script>
@endsection
