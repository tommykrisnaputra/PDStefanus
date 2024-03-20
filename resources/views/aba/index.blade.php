@extends('master')

@section('title')
	Ayo Baca Alkitab
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
					<a href="{{ route('aba.add') }}">
						<button class="action-button">
							<span>Tambah ABA</span>
						</button>
					</a>
				</div>
			</div>
			<ul class="responsive-table">
				<li class="table-header">
					<div class="col col-4">Nama</div>
					<div class="col col-4">Tanggal</div>
					<div class="col col-2">Ayat</div>
					<div class="col col-1"></div>
				</li>
				@foreach ($aba as $key => $data)
					<li class="table-row">
						<div class="col col-4" data-label="Nama">{{ $data->name ?? null }}</div>
						<div class="col col-4" data-label="Tanggal">
							{{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
						<div class="col col-2" data-label="Active">{{ $data->verses ?? null }}</div>
						<div class="col col-1" data-label="Action">
							<a class="solid-button-container" href="{{ url("aba/edit/$data->id") }}">
								<button class="solid-button-button button Button">Edit</button>
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
