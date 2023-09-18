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

@section('home-message')
@endsection

@section('content')
    <div id="main-section" class="home-main">
        <div class="home-hero">
            <div class="home-content-container">
                <h2 class="home-text06">Come &amp; join us! Every Thursday 🕖7pm</h2>
                <h2 class="home-subheading"><span>Kristoforus ⛪, Grogol, West Jakarta</span></h2>
            </div>
        </div>
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
                            <i class="fa-sharp fa-regular fa-calendar fa-lg"></i>
                            {{ $data->date->format('D d M Y') }}
                        </span>
                        <span class="place-card-text1">
                            <span>
                                {!! nl2br(e($data->description)) !!}
                            </span>
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
                                {!! nl2br(e($data->description)) !!}
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
