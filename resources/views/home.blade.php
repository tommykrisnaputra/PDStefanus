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
    {{-- <img src="https://images.unsplash.com/photo-1484627147104-f5197bcd6651?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&w=1000"
        width='1400px' height='800px' class="home-cover" /> --}}
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
        @if (count($temaPd) > 0)
            <h1>Tema PD</h1>
        @endif
        <div class="home-cards-container">
            @foreach ($temaPd as $key => $data)
                <div class="place-card-container">
                    <a href={{ $data->links }}>
                        <img alt="image" src={{ $data->media }} class="place-card-tema-pd" />
                    </a>
                    <div class="place-card-container1">
                        <span class="place-card-text">
                            <span>{{ $data->title }}</span>
                        </span>
                        <span class="place-card-text2">
                            <img alt="calendar" src="{{ asset('images/calendar.svg') }}" loading="lazy"
                                class="temapd-calendar" />
                            {{ $data->date->format('D d M Y') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        @if (count($events) > 0)
            <h1>Kegiatan PD</h1>
        @endif
        <div class="home-cards-container">
            @foreach ($events as $key => $data)
                <div class="place-card-container">
                    <img alt="image" src={{ $data->media }} class="place-card-image" />
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
