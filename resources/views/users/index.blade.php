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
            <div class="search-main-container">
                {{-- <div class="search-text">
                    <span class="search-info">Pencarian tanggal</span>
                    <div class="search-container">
                        <input type="text" name="search" placeholder="Search..." class="search-input" id="search">
                        <a href="#" class="search-btn">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>

                </div> --}}
                <div class="search-text">
                    {{-- <span class="search-info">Pencarian nama, alamat, paroki, nomor hp, instagram</span> --}}
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
                    <div class="col col-2">Tanggal Lahir</div>
                    <div class="col col-2">Alamat</div>
                    <div class="col col-1">Paroki</div>
                    <div class="col col-2">Nomor HP</div>
                    <div class="col col-1">Instagram</div>
                    <div class="col col-1">Tik Tok</div>
                    <div class="col col-2">Pertama Datang</div>
                    <div class="col col-2">Kedatangan Terakhir</div>
                    <div class="col col-1">Persentase Kedatangan</div>
                    <div class="col col-1"></div>
                </li>
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
                            <div class="col col-2" data-label="Alamat">` + res.users[i].address + ` </div>
                            <div class="col col-1" data-label="Paroki"> ` + res.users[i].paroki + ` </div>
                            <div class="col col-2" data-label="Nomor HP"> ` + res.users[i].phone + ` </div>
                            <div class="col col-1" data-label="Instagram"> <a href="https://www.instagram.com/` + res
                    .users[i].social_instagram + `" target="_blank" rel="noreferrer noopener">` +
                    res.users[i].social_instagram + `</a> </div>
                            <div class="col col-1" data-label="Tik Tok"> <a href="https://www.tiktok.com/@` + res
                    .users[i].social_tiktok + `" target="_blank" rel="noreferrer noopener">` + res.users[i].social_tiktok + `</a> </div>
                            <div class="col col-2" data-label="Pertama Datang">
                                ` + new Date(res.users[i].first_attendance).toLocaleString('id-ID', options_2) + `
                               </div>
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
