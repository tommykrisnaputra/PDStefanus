@extends('master')

@section('title')
	Absensi PD
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/events/index.css') }}" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="container">
			<div class="event">
				<div class="col col-3">{{ $events->title }} - </div>
				<div class="col col-3">{{ Carbon\Carbon::parse($events->date)->format('d M Y') ?? null }}</div>
			</div>

			@if ($events->description)
				<div class="event">
					<div class="col col-3" data-label="Deskripsi">{{ $events->description ?? null }}</div>
				</div>
			@endif

			<ul class="responsive-table">
				<li class="table-header">
					<div class="col col-3">Nama</div>
					<div class="col col-3">Kehadiran</div>
				</li>
				@foreach ($attendance as $key => $data)
					<li class="table-row">
						<div class="col col-3" data-label="Nama">{{ $data->name ?? null }}</div>
						<div class="col col-3" data-label="Action">
							<a class="solid-button-container" href="{{ url("team-attendance/update/$data->id") }}">
								@if ($data->active == '1')
									<button class="solid-button-button-active Button">Hadir</button>
								@else
									<button class="solid-button-button button Button">Belum Hadir</button>
								@endif
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection

@section('js')
@endsection
