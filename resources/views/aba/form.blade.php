@extends('master')

@section('title')
	Ayo Baca Alkitab - Edit
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/events/form.css') }}" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		@if ($errors->any())
			<div class="alert-toast">
				<div class="alert-toast-content">
					<div class="message">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</div>
				</div>
			</div>
		@endif
		<div class="container">
			<form method="POST" action="/aba/update/{{ $aba->id }}">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="title">Nama</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('title') ? 'form-error' : '' }}" id="name" name="name" type="text"
							value="{{ old('name', $aba->name ?? '') }}" placeholder="Masukan nama" disabled>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="date">Tanggal</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('date') ? 'form-error' : '' }}" id="date" name="date" type="date"
							value="{{ date('Y-m-d', strtotime(old('date', $aba->date ?? ''))) }}" placeholder="Masukan tanggal kegiatan">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="verses">Ayat</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('verses') ? 'form-error' : '' }}" id="verses" name="verses" type="text"
							value="{{ old('verses', $aba->verses ?? '') }}" placeholder="Masukan ayat alkitab">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="description">Deskripsi</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('description') ? 'form-error' : '' }}" id="description" name="description"
							type="text" value="{{ old('description', $aba->description ?? '') }}" placeholder="Masukan ayat alkitab">
					</div>
				</div>
				<div class="row submit-button-container">
					<input class="submit-button" type="submit" value="Submit">
				</div>
			</form>
		</div>
		<div class="row submit-button-container">
			<a href="{{ url("aba/delete/$aba->id") }}">
				<input class="submit-button" type="delete" value="Delete">
			</a>
		</div>
	</div>
@endsection

@section('js')
@endsection
