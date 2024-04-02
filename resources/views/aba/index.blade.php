@extends('master')

@section('title', 'Ayo Baca Alkitab')

@section('css')
	@parent
	<link href="{{ asset('css/events/index.css') }}" rel="stylesheet">
	<link href="{{ asset('css/events/search.css') }}" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="container">
			<div class="row justify-content-end">
				<form class="col-auto" method="post" action={{ route('users.export') }}>
					@csrf
					<button class="action-button" data-toggle="collapse" data-target="#collapseExample" type="button"
						aria-expanded="false" aria-controls="collapseExample">
						Advanced Search
					</button>

					{{-- <input name="full_name" type="hidden" value="{{ $data->full_name }}">
					<input name="day_from" type="hidden" value="{{ $data->day_from }}">
					<input name="day_to" type="hidden" value="{{ $data->day_to }}"> --}}
				</form>

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
				<form class="card-body" method="POST" action={{ route('users.search') }}>
					@csrf
					<div class="row row-space search-input justify-content-end">
						<div class="col-auto">
							<label class="label">Nama</label>
							<input class="input--style-1" name="full_name" type="text" {{-- value="{{ $data->$field ?? null }}"  --}} placeholder="Masukkan nama">
						</div>

						<div class="col-auto">
							<label class="label">Tanggal (from)</label>
							<input class="input--style-1" id="fa_from" name="fa_from" type="date" {{-- value="{{ $data->fa_from ?? null }}"  --}}
								placeholder="DD MMM YYYY">
						</div>

						<div class="col-auto">
							<label class="label">Tanggal (to)</label>
							<input class="input--style-1" id="fa_to" name="fa_to" type="date" {{-- value="{{ $data->fa_to ?? null }}"  --}}
								placeholder="DD MMM YYYY">
						</div>

						<div class="col-auto">
							<button class="btn-submit" type="submit">Search</button>
						</div>
					</div>
				</form>
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
