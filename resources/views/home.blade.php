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
	@include('banner')
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="home-main-container">
			@include('home/temabanner')
			<div class="home-hero">
				<div class="home-content-container">
					<div class="home-content-title">
						Come And Join Us<br>
						And Lets Grow Together in God
					</div>
					<div class="home-content-grid">
						<div class="home-content-grid-item">
							<i class="fa-solid fa-clock"></i><br>
							<span class="home-content-text">Every Thursday 19.00</span>
						</div>
						<div class="home-content-grid-item">
							<i class="fa fa-home"></i><br>
							<span class="home-content-text">Aula St.Kristoforus Grogol</span>
						</div>
						<div class="home-content-grid-item">
							<i class="fa fa-signal"></i><br>
							<span class="home-content-text">Or join us live on ig @pdstefanus</span>
						</div>
					</div>
				</div>
			</div>
			@if (count($events) > 0)
				<h1>Kegiatan PD</h1>
			@endif
			<div class="home-cards-container">
				@foreach ($events as $key => $data)
					<div class="place-card-container home-card">
						<div class="place-card-container1">
							<span class="place-card-text">
								<span>{{ $data->title }}</span><br>
							</span>
							<span class="place-card-text1">
								<span>
									{!! nl2br(e($data->description)) !!}
								</span>
							</span>
						</div>
						<img class="place-card-image" src={{ $data->media }} alt="image" />
					</div>
				@endforeach
			</div>
		</div>
		<a class="float"
			href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202."
			target="_blank">
			<i class="fa fa-whatsapp my-float"></i>
		</a>
	</div>
	@include('footer')
@endsection

@section('js')
@endsection
