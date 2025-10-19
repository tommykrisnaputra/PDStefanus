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
	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	<div class="home-main" id="main-section">
		<div class="container">
			<div class="row justify-content-md-center event">
				<div class="col col-md-10 col-sm-8">{{ $events->title }}</div>
				<div class="col col-md-2 col-sm-4">{{ Carbon\Carbon::parse($events->date)->format('d M Y') ?? null }}</div>
			</div>

			<form method="POST" action="{{ route('team-attendance.bulk-update') }}">
				@csrf
				<div class="row">
					@foreach ($attendance as $key => $data)
						<div class="col col-12 col-lg-4 col-md-6 justify-content-md-center attendance">
							<div class="col col-7" data-label="Nama">{{ $data->name ?? null }}</div>
							<div class="col col-3" data-label="Kehadiran">
								@if ($data->active == '0')
									Belum Hadir
								@else
									{{ \Carbon\Carbon::parse($data->date)->format('H:i:s') }}
								@endif
							</div>

							<div class="col col-2" data-label="Action" style="text-align: center;">
								<input name="attendance_ids[]" type="checkbox" value="{{ $data->id }}">
							</div>
						</div>
					@endforeach

					<div class="col col-12 col-lg-4 col-md-6 justify-content-md-center attendance">
						<div class="">Hadir = {{ $present }} | Belum Hadir = {{ $absent }}</div>
					</div>

					@if ($events->description)
						<div class="col col-12 justify-content-md-center attendance">
							<div class="col-12" data-label="Deskripsi">
								<div class="col col-12" data-label="Deskripsi">{{ $events->description ?? null }}</div>
							</div>
						</div>
					@endif

					<div class="col-12 mt-4 text-center">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('js')
@endsection
