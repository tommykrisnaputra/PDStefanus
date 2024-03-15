@extends('master')

@section('title')
	Kehadiran Umat
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/attendance/index.css') }}" rel="stylesheet">
	<link href="{{ asset('css/attendance/search.css') }}" rel="stylesheet">
	<link type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="container">
			<form method="post" action={{ route('attendance.export') }}>
				@csrf
				<div class="search-button mb20 btn-group">
					<button class="btn btn-primary col col-md-3" data-toggle="collapse" data-target="#collapseExample" type="button"
						aria-expanded="false" aria-controls="collapseExample">
						Advanced Search
					</button>

					<input name="date_from" type="hidden" value="{{ $data->date_from }}">
					<input name="date_to" type="hidden" value="{{ $data->date_to }}">
					<input name="fa_from" type="hidden" value="{{ $data->fa_from }}">
					<input name="fa_to" type="hidden" value="{{ $data->fa_to }}">
					<input name="full_name" type="hidden" value="{{ $data->full_name }}">
					<input name="phone" type="hidden" value="{{ $data->phone }}">
					<input name="wilayah" type="hidden" value="{{ $data->wilayah }}">

					<button class="btn btn-info col col-md-3" name="action" type="submit" value="download">
						Download Excel
					</button>
				</div>
			</form>
			<div class="card card-6 search-main-container mb20 collapse" id="collapseExample">
				<div class="card-body">
					<form method="POST" action={{ route('attendance.index') }}>
						@csrf
						<!-- {{ csrf_field() }} -->
						<div class="row row-space">
							<div class="search-4">
								<div class="input-group">
									<label class="label">Kehadiran (from)</label>
									<input class="input--style-1" id="date_from" name="date_from" type="date"
										value="{{ $data->date_from ?? null }}">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Kehadiran (to)</label>
									<input class="input--style-1" id="date_to" name="date_to" type="date"
										value="{{ $data->date_to ?? null }}">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Pertama Datang (from)</label>
									<input class="input--style-1" id="fa_from" name="fa_from" type="date" value="{{ $data->fa_from ?? null }}"
										placeholder="DD MMM YYYY">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Pertama Datang (to)</label>
									<input class="input--style-1" id="fa_to" name="fa_to" type="date" value="{{ $data->fa_to ?? null }}"
										placeholder="DD MMM YYYY">
								</div>
							</div>
						</div>
						<div class="row row-space">
							<div class="search-4">
								<div class="input-group">
									<label class="label">Nama Umat</label>
									<input class="input--style-1" name="full_name" type="text" value="{{ $data->full_name ?? null }}"
										placeholder="Masukkan nama umat">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Nomor HP</label>
									<input class="input--style-1" name="phone" type="tel" value="{{ $data->phone ?? null }}"
										placeholder="Masukkan nomor HP">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Wilayah</label>
									<input class="input--style-1" name="wilayah" type="text" value="{{ $data->wilayah ?? null }}"
										placeholder="Masukkan wilayah">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<button class="btn-submit m-b-0 mt20" name="action" type="submit" value="search">search</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			{{--  --}}

			<ul class="responsive-table">
				<li class="table-header">
					<div class="col table-2">Nama Umat</div>
					<div class="col table-2">Nomor HP</div>
					<div class="col table-2">Tanggal Kehadiran</div>
					<div class="col table-2">Pertama Datang</div>
					<div class="col table-2">Total Kehadiran</div>
					<div class="col table-2">Persentase Kehadiran</div>
					{{-- <div class="col table-2"></div> --}}
				</li>

				@foreach ($attendance as $key => $data)
					<li class="table-row">
						<div class="col table-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
						<div class="col table-2" data-label="Nomor HP">
							<a href="https://wa.me/{{ $data->phone }}">
								{{ $data->phone ?? null }}
							</a>
						</div>
						<div class="col table-2" data-label="Tanggal Kehadiran">
							{{ Carbon\Carbon::parse($data->date)->format('d M Y') ?? null }}</div>
						<div class="col table-2" data-label="Pertama Datang">
							{{ Carbon\Carbon::parse($data->first_attendance)->format('d M Y') ?? null }}</div>
						<div class="col table-2" data-label="Total Kehadiran">{{ $data->total_attendance ?? null }}
						</div>
						<div class="col table-2" data-label="Persentase Kehadiran">
							{{ $data->attendance_percentage ?? null }}%
						</div>
						{{-- <a href="{{ url("users/edit/$data->id") }}" class="solid-button-container">
                            <button class="solid-button-button button Button">Detail</button>
                        </a> --}}
						{{-- </div> --}}
						</a>
					</li>
				@endforeach
				{{ $attendance->appends($_POST)->links() }}
			</ul>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script type="text/javascript">
		$('.daterange').daterangepicker({
			startDate: moment().day(-3),
			endDate: moment().day(4),
			locale: {
				format: 'DD MMM YYYY'
			}
		});
	</script>
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
