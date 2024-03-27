@extends('master')

@section('title', 'Ayo Baca Alkitab')

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
					<div class="col col-4">Ayat</div>
					<div class="col col-4"></div>
				</li>
				@foreach ($aba as $data)
					<li class="table-row">
						<div class="col col-4" data-label="Nama">{{ $data->name }}</div>
						<div class="col col-4" data-label="Tanggal">{{ $data->date->format('d M Y') }}</div>
						<div class="col col-4" data-label="Ayat">{{ $data->verses }}</div>
						<div class="col col-4" data-label="Action">
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
