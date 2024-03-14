@extends('master')

@section('title')
	Absensi PD
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/events/index.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="container">
			<div class="row justify-content-md-center event">
				<div class="col col-10">{{ $events->title }}</div>
				<div class="col col-2">{{ Carbon\Carbon::parse($events->date)->format('d M Y') ?? null }}</div>
			</div>

			@if ($events->description)
				<div class="row justify-content-md-center event">
					<div class="col col-12" data-label="Deskripsi">{{ $events->description ?? null }}</div>
				</div>
			@endif

			<div class="row">
				@foreach ($attendance as $key => $data)
					<div class="col col-lg-4 col-md-6 col-sm-12 attendance">
						<div class="col col-6" data-label="Nama">{{ $data->name ?? null }}</div>
						<div class="col col-6" data-label="Action">
							<a class="solid-button-container" href="{{ url("team-attendance/update/$data->id") }}">
								@if ($data->active == '1')
									<button class="solid-button-button-active Button attendance-font">Hadir</button>
								@else
									<button class="solid-button-button-nonactive button Button attendance-font mt-8">Belum Hadir</button>
								@endif
							</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
