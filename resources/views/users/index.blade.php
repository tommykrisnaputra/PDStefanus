@extends('master')

@section('title')
    Umat PD
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="container">
            <div class="search-container">
                <input type="text" name="search" placeholder="Search (name)..." class="search-input" id="search">
                <a href="#" class="search-btn">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-2">Nama</div>
                    <div class="col col-3">Tanggal Lahir</div>
                    <div class="col col-1">Alamat</div>
                    <div class="col col-2">Paroki</div>
                    <div class="col col-2">Nomor HP</div>
                    <div class="col col-2">Instagram</div>
                    <div class="col col-3">Pertama Datang</div>
                    <div class="col col-3">Kedatangan Terakhir</div>
                    <div class="col col-3">Persentase Kedatangan</div>
                    <div class="col col-3"></div>
                </li>
                <div class="table-rows">
                    {{-- @foreach ($users as $key => $data) --}}
                    {{-- <li class="table-row"> --}}
                    {{-- <div class="col col-2" data-label="Nama">{{ $data->full_name }}</div>
                            <div class="col col-3" data-label="Tanggal Lahir">
                                {{ date('d-m-Y', strtotime($data->birthdate)) }}</div>
                            <div class="col col-1" data-label="Alamat">{{ $data->address }}</div>
                            <div class="col col-2" data-label="Paroki">{{ $data->paroki }}</div>
                            <div class="col col-2" data-label="Nomor HP">{{ $data->phone_number }}</div>
                            <div class="col col-2" data-label="Instagram">{{ $data->social_instagram }}</div>
                            <div class="col col-3" data-label="Pertama Datang">
                                {{ date('d-m-Y', strtotime($data->first_attendance)) }}</div>
                            <div class="col col-3" data-label="Kedatangan Terakhir">
                                {{ date('d-m-Y', strtotime($data->last_attendance)) }}</div>
                            <div class="col col-3" data-label="Persentase Kedatangan">
                                {{ $data->attendance_percentage }}%</div>
                            <div class="col col-3" data-label="Action">
                                <a href="{{ url('users/edit', ['id' => $data->id]) }}" class="solid-button-container">
                                    <button class="solid-button-button button Button">Edit</button>
                                </a>
                            </div> --}}
                    {{-- </li> --}}
                    {{-- @endforeach --}}
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
                            <div class="col col-2" data-label="Nama"> ` + res.users[i].full_name + ` </div>
                            <div class="col col-3" data-label="Tanggal Lahir">
                                ` + new Date(res.users[i].birthdate).toLocaleString('id-ID', options) + `</div>
                            <div class="col col-1" data-label="Alamat">` + res.users[i].address + ` </div>
                            <div class="col col-2" data-label="Paroki"> ` + res.users[i].paroki + ` </div>
                            <div class="col col-2" data-label="Nomor HP"> ` + res.users[i].phone_number + ` </div>
                            <div class="col col-2" data-label="Instagram"> ` + res.users[i].social_instagram + ` </div>
                            <div class="col col-3" data-label="Pertama Datang">
                                ` + new Date(res.users[i].first_attendance).toLocaleString('id-ID', options) + `
                               </div>
                            <div class="col col-3" data-label="Kedatangan Terakhir">
                                ` + new Date(res.users[i].last_attendance).toLocaleString('id-ID', options) + `
                                </div>
                            <div class="col col-3" data-label="Persentase Kedatangan">
                                 ` + res.users[i].attendance_percentage + `%</div>
                            <div class="col col-3" data-label="Action">
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
