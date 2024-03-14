@extends('master')

@section('title')
	PD Stefanus
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/home.css') }}" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('home-message')
@endsection

@section('content')
	<div class="home-main" id="main-section">
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
						<img class="place-card-tema-pd" src={{ $data->media }} alt="image" />
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
					<img class="place-card-image" src={{ $data->media }} alt="image" />
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
	<a class="float"
		href="https://api.whatsapp.com/send?phone=087877828233&text=Halo%20admin%20PD%20Stefanus!"
		target="_blank">
		<i class="fa fa-whatsapp my-float"></i>
	</a>
	@include('footer')
@endsection

@section('js')
@endsection
