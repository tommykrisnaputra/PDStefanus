@extends('master')

@section('title', 'Lupa Lapor ABA')

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
	<?php $now = Carbon\Carbon::now(); ?>
	<div class="home-main" id="main-section">
		<div class="container">
			<ul class="responsive-table">
				<li class="table-header">
					<div class="col col-4">Nama</div>
					<div class="col col-4">Tanggal Terakhir Lapor</div>
					<div class="col col-4">Total Hari</div>
				</li>
				@foreach ($users as $data)
					<?php $days_count = Carbon\Carbon::parse($data->last_aba)->diffInDays($now); ?>
					<li class="table-row">
						<div class="col col-4" data-label="Nama">{{ $data->full_name }}</div>
						<div class="col col-4" data-label="Tanggal Terakhir Lapor">
							{{ $data->last_aba ? $data->last_aba->format('d M Y') : '' }}</div>
						<div class="col col-4" data-label="Total Hari">{{ $days_count }}</div>
					</li>
				@endforeach
				{{ $users->appends($_POST)->links() }}
			</ul>
		</div>
	</div>
@endsection

@section('js')
@endsection
