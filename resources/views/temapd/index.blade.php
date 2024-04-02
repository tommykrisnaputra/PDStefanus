@extends('master')

@section('title')
	Tema PD
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
			<div class="row justify-content-end links-container">
				<a class="col-auto" href="{{ route('temapd.add') }}">
					<button class="action-button">
						<span>Tambah Tema PD</span>
					</button>
				</a>
			</div>
			
			<ul class="responsive-table">
				<li class="table-header">
					<div class="col col-4">Nama</div>
					<div class="col col-4">Tanggal Kegiatan</div>
					<div class="col col-2">Active</div>
					<div class="col col-4">Deskripsi</div>
					<div class="col col-1"></div>
				</li>
				@foreach ($TemaPd as $key => $data)
					<li class="table-row">
						<div class="col col-4" data-label="Nama">{{ $data->title ?? null }}</div>
						<div class="col col-4" data-label="Tanggal Kegiatan">
							{{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
						<div class="col col-2" data-label="Active">{{ $data->active ? 'Active' : null }}</div>
						<div class="col col-4" data-label="Deskripsi">{{ $data->description ?? null }}</div>
						<div class="col col-1" data-label="Action">
							<a class="solid-button-container" href="{{ url("temapd/edit/$data->id") }}">
								<button class="solid-button-button button Button">Edit</button>
							</a>
						</div>
					</li>
				@endforeach
				{{ $TemaPd->appends($_POST)->links() }}
			</ul>
		</div>
	</div>
@endsection

@section('js')
@endsection
