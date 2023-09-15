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
                    <div class="col col-2">Tanggal Kegiatan</div>
                    {{-- <div class="col col-1">Media</div>
                    <div class="col col-1">Links</div> --}}
                    <div class="col col-4">Deskripsi</div>
                    <div class="col col-1">Active</div>
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
        // $('#search').on('keyup', function() {
        //     search();
        // });
        search();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function search() {
            var keyword = $('#search').val();
            $.post('{{ route('temapd.search') }}', {
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
            for (let i = 0; i < res.TemaPd.length; i++) {
                if (res.TemaPd.length <= 0) {
                    htmlView += `
                    <tr>
                        <td colspan="4">No data.</td>
                    </tr>`;
                }
                htmlView += `
                        <li class="table-row">
                            <div class="col col-2" data-label="Nama"> ` + res.TemaPd[i].title + ` </div>
                            <div class="col col-2" data-label="Tanggal Kegiatan">
                                ` + new Date(res.TemaPd[i].date).toLocaleString('id-ID', options_2) + `</div>
                            <div class="col col-4" data-label="Deskripsi"> ` + res.TemaPd[i].description + ` </div>
                            <div class="col col-1" data-label="Active"> ` + res.TemaPd[i].active + ` </div>
                            <div class="col col-1" data-label="Action">
                                <a href="{{ url('temapd/edit/`+res.TemaPd[i].id+`') }}" class="solid-button-container">
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


{{-- <div class="col col-1" data-label="Media"> ` + res.TemaPd[i].media + ` </div>
                            <div class="col col-1" data-label="Links"> ` + res.TemaPd[i].links + ` </div> --}}
