@extends('master')

@section('title')
	Umat PD
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/users/index.css') }}" rel="stylesheet">
	<link href="{{ asset('css/attendance/search.css') }}" rel="stylesheet">
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	<div class="home-main" id="main-section">
		<div class="container">
			<form method="post" action={{ route('users.export') }}>
				@csrf
				<div class="search-button mb20 btn-group">
					<button class="btn btn-primary col col-md-3" data-toggle="collapse" data-target="#collapseExample" type="button"
						aria-expanded="false" aria-controls="collapseExample">
						Advanced Search
					</button>

					<input name="full_name" type="hidden" value="{{ $data->full_name }}">
					<input name="phone" type="hidden" value="{{ $data->phone }}">
					<input name="paroki" type="hidden" value="{{ $data->paroki }}">
					<input name="wilayah" type="hidden" value="{{ $data->wilayah }}">
					<input name="email" type="hidden" value="{{ $data->email }}">
					<input name="role" type="hidden" value="{{ $data->role }}">
					<input name="date_from" type="hidden" value="{{ $data->date_from }}">
					<input name="date_to" type="hidden" value="{{ $data->date_to }}">
					<input name="fa_from" type="hidden" value="{{ $data->fa_from }}">
					<input name="fa_to" type="hidden" value="{{ $data->fa_to }}">
					<input name="day_from" type="hidden" value="{{ $data->day_from }}">
					<input name="day_to" type="hidden" value="{{ $data->day_to }}">
					<input name="total_op" type="hidden" value="{{ $data->total_op }}">
					<input name="percentage_op" type="hidden" value="{{ $data->percentage_op }}">

					<button class="btn btn-info col col-md-3" type="submit">
						Download Excel
					</button>
				</div>
			</form>
			<div class="card card-6 search-main-container mb20 collapse" id="collapseExample">
				<div class="card-body">
					<form method="POST" action={{ route('users.search') }}>
						@csrf
						<!-- {{ csrf_field() }} -->
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
									<label class="label">Paroki</label>
									<input class="input--style-1" name="paroki" type="text" value="{{ $data->paroki ?? null }}"
										placeholder="Masukkan paroki">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Wilayah</label>
									<input class="input--style-1" name="wilayah" type="text" value="{{ $data->wilayah ?? null }}"
										placeholder="Masukkan wilayah">
								</div>
							</div>
						</div>
						<div class="row row-space">
							<div class="search-4">
								<div class="input-group">
									<label class="label">Email</label>
									<input class="input--style-1" name="email" type="email" value="{{ $data->email ?? null }}"
										placeholder="Masukkan email">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Roles</label>
									<select class="input--style-1 width-100" name="role">
										@foreach ($data->roles as $item => $value)
											<option value="{{ $item }}" @selected($item == $data->role)>
												{{ $value }}
											</option>
										@endforeach
									</select>
								</div>
							</div>
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
						</div>
						<div class="row row-space">
							<div class="search-4">
								<div class="input-group">
									<label class="label">Pertama Datang (from)</label>
									<input class="input--style-1" id="fa_from" name="fa_from" type="date"
										value="{{ $data->fa_from ?? null }}" placeholder="DD MMM YYYY">
								</div>
							</div>
							<div class="search-4">
								<div class="input-group">
									<label class="label">Pertama Datang (to)</label>
									<input class="input--style-1" id="fa_to" name="fa_to" type="date"
										value="{{ $data->fa_to ?? null }}" placeholder="DD MMM YYYY">
								</div>
							</div>
							<div class="search-op">
								<div class="input-group">
									<label class="label">Tanggal Lahir (from)</label>
									<select class="input--style-2 operator" name="day_from">
										@foreach ($data->days as $item)
											<option value="{{ $item }}" @selected($item == $data->day_from)>
												{{ $item }}
											</option>
										@endforeach
									</select>
									<select class="input--style-2" name="month_from">
										@foreach ($data->months as $item)
											<option value="{{ $item }}" @selected($item == $data->month_from)>
												{{ $item }}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="search-op">
								<div class="input-group">
									<label class="label">Tanggal Lahir (to)</label>
									<select class="input--style-2 operator" name="day_to">
										@foreach ($data->days as $item)
											<option value="{{ $item }}" @selected($item == $data->day_to)>
												{{ $item }}
											</option>
										@endforeach
									</select>
									<select class="input--style-2" name="month_to">
										@foreach ($data->months as $item)
											<option value="{{ $item }}" @selected($item == $data->month_to)>
												{{ $item }}
											</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row row-space">
							<div class="search-op">
								<div class="input-group">
									<label class="label">Total Kedatangan</label>
									<select class="input--style-2 operator" name="total_op">
										@foreach ($data->operators as $item)
											<option value="{{ $item }}" @selected($item == $data->total_op)>
												{{ $item }}
											</option>
										@endforeach
									</select>
									<input class="input--style-3" name="total_attendance" type="tel"
										value="{{ $data->total_attendance ?? null }}" placeholder="Masukkan total kedatangan">
								</div>
							</div>
							<div class="search-op">
								<div class="input-group">
									<label class="label">Kedatangan (%)</label>
									<select class="input--style-2 operator" name="percentage_op">
										@foreach ($data->operators as $item)
											<option value="{{ $item }}" @selected($item == $data->percentage_op)>
												{{ $item }}
											</option>
										@endforeach
									</select>
									<input class="input--style-3" name="attendance_percentage" type="tel"
										value="{{ $data->attendance_percentage ?? null }}" placeholder="Masukkan persentase">
								</div>
							</div>
							<div class="search-4">
							</div>
							<div class="search-4">
								<div class="input-group">
									<button class="btn-submit m-b-0 mt40" type="submit">search</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<ul class="responsive-table">
				<li class="table-header">
					<div class="col table-2">Nama</div>
					<div class="col table-2">Tanggal Lahir</div>
					<div class="col table-2">Wilayah</div>
					<div class="col table-1">Nomor HP</div>
					<div class="col table-1">Instagram</div>
					<div class="col table-1">Terakhir Datang</div>
					<div class="col table-1">Persentase Kedatangan</div>
					<div class="col table-1"></div>
				</li>
				@foreach ($users as $key => $data)
					<li class="table-row">
						<div class="col table-2" data-label="Nama Umat">{{ $data->full_name ?? null }}</div>
						<div class="col table-2" data-label="Tanggal Lahir">
							{{ Carbon\Carbon::parse($data->birthdate)->format('d M Y') ?? null }}</div>
						<div class="col table-2" data-label="Wilayah">{{ $data->wilayah ?? null }}</div>
						<div class="col table-1" data-label="Nomor HP">
							<a href="https://wa.me/{{ $data->phone }}">
								{{ $data->phone ?? null }}
							</a>
						</div>
						<div class="col table-1" data-label="Instagram">
							<a href="https://www.instagram.com/{{ $data->social_instagram }}">
								{{ $data->social_instagram ?? null }}
							</a>
						</div>
						<div class="col table-1" data-label="Terakhir Datang">
							{{ Carbon\Carbon::parse($data->last_attendance)->format('d M Y') ?? null }}</div>
						<div class="col table-1" data-label="Persentase Kehadiran">
							{{ $data->attendance_percentage ?? null }}%
						</div>
						<div class="col table-1" data-label="Action">
							<a class="solid-button-container" href="{{ url("users/edit/$data->id") }}">
								<button class="solid-button-button button Button">Edit</button>
							</a>
						</div>
					</li>
				@endforeach
				{{ $users->appends($_POST)->links() }}
			</ul>
		</div>
	</div>
@endsection

@section('js')
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script> --}}
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
@endsection
