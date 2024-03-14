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
			<div class="search-main-container">
				<div class="buttons">
					<a href="{{ route('team-events.add') }}">
						<button class="action-button">
							<span>Tambah Kegiatan</span>
						</button>
					</a>
				</div>
			</div>
			<ul class="responsive-table">
				<li class="table-header">
					<div class="col col-3">Nama</div>
					<div class="col col-3">Tanggal Kegiatan</div>
					<div class="col col-1"></div>
					<div class="col col-1"></div>
				</li>
				@foreach ($events as $key => $data)
					<li class="table-row">
						<div class="col col-3" data-label="Nama">{{ $data->title ?? null }}</div>
						<div class="col col-3" data-label="Tanggal Kegiatan">
							{{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
						<div class="col col-1" data-label="Action">
                            <a href="{{ url("team-events/edit/$data->id") }}" class="solid-button-container">
                                <button class="solid-button-button button Button">Edit</button>
                            </a>
                        </div>
						<div class="col col-1" data-label="Action">
							<a class="solid-button-container" href="{{ url("team-attendance/$data->id") }}">
								<button class="solid-button-button button Button">Absen</button>
							</a>
						</div>
					</li>
				@endforeach
				{{ $events->appends($_POST)->links() }}
			</ul>
		</div>
	</div>
@endsection

@section('js')
@endsection
