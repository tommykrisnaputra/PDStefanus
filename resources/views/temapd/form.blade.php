@extends('master')

@section('title')
	Tema PD - Edit
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
		{{-- {{ $TemaPd }} --}}
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
			<form method="POST" action="/temapd/update/{{ $TemaPd->id }}">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="title">Nama Kegiatan</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('title') ? 'form-error' : '' }}" id="title" name="title" type="text"
							value="{{ old('title', $TemaPd->title ?? '') }}" placeholder="Masukan nama kegiatan">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="date">Tanggal Kegiatan</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('date') ? 'form-error' : '' }}" id="date" name="date" type="date"
							value="{{ date('Y-m-d', strtotime(old('date', $TemaPd->date ?? ''))) }}" placeholder="Masukan tanggal kegiatan">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="media">Media</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('media') ? 'form-error' : '' }}" id="media" name="media" type="text"
							value="{{ old('media', $TemaPd->media ?? '') }}" placeholder="Masukan url media">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="links">Links</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('links') ? 'form-error' : '' }}" id="links" name="links" type="text"
							value="{{ old('links', $TemaPd->links ?? '') }}" placeholder="Masukan url kegiatan">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="active">Active</label>
					</div>
					<div class="col-75">
						<select class="{{ $errors->has('active') ? 'form-error' : '' }}" id="active" name="active"
							value="{{ old('active', $TemaPd->active ?? '') }}" placeholder="Masukan active">
							<option value="1" @selected($TemaPd->active)>Yes</option>
							<option value="0" @selected(!$TemaPd->active)>No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="description">Deskripsi</label>
					</div>
					<div class="col-75">
						<textarea id="description" name="description" style="height:200px">{{ old('description', $TemaPd->description ?? '') }}</textarea>
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
