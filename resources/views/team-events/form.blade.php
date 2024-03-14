@extends('master')

@section('title')
	Kegiatan PD - Edit
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
		{{-- {{ $events }} --}}
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
			<form method="POST" action="/team-events/update/{{ $events->id }}">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="title">Nama Kegiatan</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('title') ? 'form-error' : '' }}" id="title" name="title" type="text"
							value="{{ old('title', $events->title ?? '') }}" placeholder="Masukan nama kegiatan">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="date">Tanggal Kegiatan</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('date') ? 'form-error' : '' }}" id="date" name="date" type="date"
							value="{{ date('Y-m-d', strtotime(old('date', $events->date ?? ''))) }}" placeholder="Masukan tanggal kegiatan">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="active">Active</label>
					</div>
					<div class="col-75">
						<select class="{{ $errors->has('active') ? 'form-error' : '' }}" id="active" name="active"
							value="{{ old('active', $events->active ?? '') }}" placeholder="Masukan active">
							<option value="1" @selected($events->active)>Yes</option>
							<option value="0" @selected(!$events->active)>No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="description">Deskripsi</label>
					</div>
					<div class="col-75">
						<textarea id="description" name="description" style="height:200px">{{ old('description', $events->description ?? '') }}</textarea>
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
