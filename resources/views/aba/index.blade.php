@extends('master')

@section('title', 'Ayo Baca Alkitab')

@section('css')
	@parent
	<link href="{{ asset('css/events/index.css') }}" rel="stylesheet">
	<link href="{{ asset('css/attendance/search.css') }}" rel="stylesheet">
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
				<div class="mb20 col-auto">
					@csrf
					<button class="action-button col-auto" data-toggle="collapse" data-target="#collapseExample" type="button"
						aria-expanded="false" aria-controls="collapseExample">
						Advanced Search
					</button>
				</div>

				<a class="col-auto" href="{{ route('aba.forgot') }}">
					<button class="action-button">
						<span>Lupa Lapor</span>
					</button>
				</a>

				<a class="col-auto" href="{{ route('aba.add') }}">
					<button class="action-button">
						<span>Tambah ABA</span>
					</button>
				</a>
			</div>

			<div class="card card-6 collapse" id="collapseExample">
				<div class="card-body">
					<form method="POST" action={{ route('aba.search') }}>
						@csrf
						<div class="row row-space">
							<div class="search-4">
								<div class="input-group">
									<label class="label">Nama</label>
									<input class="input--style-1" id="full_name" name="full_name" type="text"
										value="{{ $data->full_name ?? null }}" placeholder="Masukkan nama">
								</div>
							</div>

							<div class="search-4">
								<div class="input-group">
									<label class="label">Tanggal (from)</label>
									<input class="input--style-1" id="date_from" name="date_from" type="date"
										value="{{ $data->date_from ?? date('Y-m-d') }}">
								</div>
							</div>

							<div class="search-4">
								<div class="input-group">
									<label class="label">Tanggal (to)</label>
									<input class="input--style-1" id="date_to" name="date_to" type="date"
										value="{{ $data->date_to ?? date('Y-m-d') }}">
								</div>
							</div>

							<div class="search-4">
								<div class="input-group">
									<button class="btn-submit m-b-0" type="submit">Search</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<ul class="responsive-table">
				<li class="table-header">
					<div class="col col-4">Nama</div>
					<div class="col col-4">Tanggal</div>
					<div class="col col-4">Ayat</div>
					<div class="col col-1"></div>
				</li>
				@foreach ($aba as $data)
					<li class="table-row">
						<div class="col col-4" data-label="Nama">{{ $data->name }}</div>
						<div class="col col-4" data-label="Tanggal">{{ $data->date->format('d M Y') }}</div>
						<div class="col col-4" data-label="Ayat">{{ $data->verses }}</div>
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
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
@endsection
