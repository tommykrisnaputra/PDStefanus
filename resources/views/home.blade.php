@extends('master')

@section('title')
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="home-hero">
        <div class="home-content-container">
            <h1 class="home-text06">Come &amp; join us</h1>
            <h1 class="home-subheading">
                <span>Every Thursday 🕖7pm</span>
                <br class="Subheading" />
                <span>Kristoforus ⛪, Grogol, West Jakarta</span>
            </h1>
            <span class="home-text10">
                <span>WA: 0878 7782 8233</span>
                <br />
                <span>Link Stefannews 2022 👇👇</span>
                <br />
                <a href="https://linktr.ee/PDSt.Stefanus" class="home-text15">linktr.ee/PDSt.Stefanus</a>
            </span>
        </div>
    </div>
    <div id="main-section" class="home-main">
        <h1>Tema PD</h1>
        <div class="home-cards-container">
            <div class="place-card-container">
                <img alt="image"
                    src="https://images.unsplash.com/photo-1529655683826-aba9b3e77383?ixlib=rb-1.2.1&amp;q=85&amp;fm=jpg&amp;crop=entropy&amp;cs=srgb&amp;h=1000"
                    class="place-card-image" />
                <div class="place-card-container1">
                    <span class="place-card-text">
                        <span>Tumbuhkan Cinta Dalam Keluarga</span>
                    </span>
                    <span class="place-card-text1">
                        <span>
                            Kalau kamu belum menerapkan ‘cinta’ di dalam keluarga, coba
                            yuk sesekali menelpon orang tuamu, kakak, atau adikmu untuk
                            sekadar menanyakan kabar mereka. Sekecil apapun perbuatanmu
                            untuk keluarga,sebetulnya sangat berarti.
                        </span>
                    </span>
                </div>
            </div>
            <div class="place-card-container">
                <img alt="image"
                    src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?ixlib=rb-1.2.1&amp;q=85&amp;fm=jpg&amp;crop=entropy&amp;cs=srgb&amp;h=1000"
                    class="place-card-image" />
                <div class="place-card-container1">
                    <span class="place-card-text">
                        <span>Home Alone Together</span>
                    </span>
                    <span class="place-card-text1">
                        <span>
                            February biasanya identik dg Love ya Stefaners 😍 Kalo
                            ngmngin soal Cinta, bukan melulu ke pasangan😯 Tapi,
                            Keluarga juga seharusnya menjadi sumber Cinta kita❤️ Tapi
                            pernah gak kamu merasa sendiri, Hampa dan merasa tidak ada
                            Cinta di dalam keluarga? 🤔
                        </span>
                    </span>
                </div>
            </div>
            <div class="place-card-container">
                <img alt="image"
                    src="https://images.unsplash.com/photo-1513342791620-b106dc487c94?ixlib=rb-1.2.1&amp;q=85&amp;fm=jpg&amp;crop=entropy&amp;cs=srgb&amp;h=1000"
                    class="place-card-image" />
                <div class="place-card-container1">
                    <span class="place-card-text">
                        <span>Memiliki Iman Yang Kuat</span>
                    </span>
                    <span class="place-card-text1">
                        <span>
                            Buah dari iman adalah damai sejahtera dan sukacita. Lakukan
                            hal kecil dengan cinta yang besar. -St. Teresa dari Kalkuta-
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <h1>Kegiatan PD</h1>
        <div class="home-cards-container">
            @foreach ($events as $key => $data)
                <div class="place-card-container">
                    <img alt="image"
                        src={{ $data->media }}
                        class="place-card-image" />
                    <div class="place-card-container1">
                        <span class="place-card-text">
                            <span>{{ $data->title }}</span>
                        </span>
                        <span class="place-card-text1">
                            <span>
                                {{ $data->description }}
                            </span>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('footer')
@endsection

@section('js')
@endsection
