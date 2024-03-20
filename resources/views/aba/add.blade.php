@extends('master')

@section('title')
	Ayo Baca Alkitab - Add
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/events/add.css') }}" rel="stylesheet">
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
			<form method="POST" action="/aba/create">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="date">Tanggal</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('date') ? 'form-error' : '' }}" id="date" name="date" type="date"
							value="{{ date('Y-m-d') }}" placeholder="Masukan tanggal">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="verses">Ayat</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('verses') ? 'form-error' : '' }}" id="verses" name="verses" type="text"
							value="{{ old('verses') }}" placeholder="Masukan ayat alkitab">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="description">Deskripsi</label>
					</div>
					<div class="col-75">
						<textarea id="description" name="description" style="height:100px">{{ old('description') }}</textarea>
					</div>
				</div>
				<div class="row submit-button-container">
					<input class="submit-button" type="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
@endsection

@section('js')
@endsection
