@extends('master')

@section('title')
	Absensi PD
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/events/index.css') }}" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="container">
			<div class="row justify-content-md-center event">
				<div class="col col-md-10 col-sm-8">{{ $events->title }}</div>
				<div class="col col-md-2 col-sm-4">{{ Carbon\Carbon::parse($events->date)->format('d M Y') ?? null }}</div>
			</div>

			<div class="row">
				@foreach ($attendance as $key => $data)
					<div class="col col-12 col-lg-4 col-md-6 justify-content-md-center attendance">
						<div class="col col-6" data-label="Nama">{{ $data->name ?? null }}</div>
						<div class="col col-6" data-label="Action">
							<a class="solid-button-container" href="{{ url("team-attendance/update/$data->id") }}">
								@if ($data->active == '1')
									<button class="solid-button-button-active Button attendance-font">
										{{ Carbon\Carbon::parse($data->date)->format('H:i:s') ?? null }}
									</button>
								@else
									<button class="solid-button-button-nonactive button Button attendance-font">Belum Hadir</button>
								@endif
							</a>
						</div>
					</div>
				@endforeach

				<div class="col col-12 col-lg-4 col-md-6 justify-content-md-center attendance">
					<div class="">Hadir = {{ $present }} Belum Hadir = {{ $absent }}</div>
				</div>

				@if ($events->description)
					<div class="col col-12 justify-content-md-center attendance">
						<div class="col-12" data-label="Deskripsi">
							<div class="col col-12" data-label="Deskripsi">{{ $events->description ?? null }}</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
