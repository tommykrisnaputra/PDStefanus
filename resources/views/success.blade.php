@extends('master')

@section('title')
@endsection

@section('css')
	@parent
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
	<link href="{{ asset('css/success.css') }}" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="card">
		<div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
			<i class="checkmark">✓</i>
		</div>
		<span class="message">Success</span>
		<p>Pendaftaran anda sudah berhasil!</p>
	</div>
@endsection

@section('js')
@endsection
