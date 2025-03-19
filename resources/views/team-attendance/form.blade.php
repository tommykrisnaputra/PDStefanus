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

			<ul class="responsive-table">
				<li class="table-header">
					<div class="col table-2">Nama</div>
					<div class="col table-2">Status</div>
					<div class="col table-2">Deskripsi</div>
					<div class="col table-6">Action</div>
				</li>

				@foreach ($attendance as $key => $data)
					<li class="table-row">
						<div class="col table-2" data-label="Nama">{{ $data->name ?? null }}</div>
						<div class="col table-2" data-label="Status">
							@if ($data->active == '1')
								{{ Carbon\Carbon::parse($data->date)->format('H:i:s') ?? null }}
							@else
								Belum Hadir
							@endif
						</div>
						<div class="col table-2" data-label="Deskripsi">{{ $data->description ?? null }}</div>
						<div class="col table-2" data-label="Action">
							<button class="solid-button-button-nonactive button Button attendance-font">
								Belum Hadir
							</button>
							@if ($data->active == '1')
								<button class="solid-button-button-active Button attendance-font">
									{{ Carbon\Carbon::parse($data->date)->format('H:i:s') ?? null }}
								</button>
							@else
								<button class="solid-button-button-nonactive button Button attendance-font">Belum Hadir</button>
							@endif
						</div>
						</a>
					</li>
				@endforeach
			</ul>

			<div class="row justify-content-md-center event">
				<div class="col col-md-6">Hadir = {{ $present }}</div>
				<div class="col col-md-6">Belum Hadir = {{ $absent }}</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
