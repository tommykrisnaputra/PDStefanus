@extends('master')

@section('title')
	Umat PD - Edit
@endsection

@section('css')
	@parent
	<link href="{{ asset('css/users/form.css') }}" rel="stylesheet">
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
			<form method="POST" action="/users/update/{{ $users->id }}">
				@csrf
				<!-- {{ csrf_field() }} -->
				<div class="row">
					<div class="col-25">
						<label for="full_name">Nama Lengkap</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('full_name') ? 'form-error' : '' }}" id="full_name" name="full_name" type="text"
							value="{{ old('full_name', $users->full_name ?? '') }}" placeholder="Masukan nama">
					</div>
				</div>
				@if (auth()->user()->isAdmin())
					<div class="row">
						<div class="col-25">
							<label for="role">Role</label>
						</div>
						<div class="col-75">
							<select class="{{ $errors->has('role') ? 'form-error' : '' }}" id="role" name="role"
								value="{{ old('role', $roles->id ?? '') }}" placeholder="Masukan role">
								<option value="1" @selected($roles->id == 1)>Umat</option>
								<option value="2" @selected($roles->id == 2)>Admin</option>
								<option value="3" @selected($roles->id == 3)>Tim</option>
							</select>
						</div>
					</div>
				@endif
				<div class="row">
					<div class="col-25">
						<label for="email">Email</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('email') ? 'form-error' : '' }}" id="email" name="email" type="email"
							value="{{ old('email', $users->email ?? '') }}" placeholder="Masukan email">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="phone">Nomor HP</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('phone') ? 'form-error' : '' }}" id="phone" name="phone" type="tel"
							value="{{ old('phone', $users->phone ?? '') }}" placeholder="Masukan nomor HP">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="birthdate">Tanggal Lahir</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('birthdate') ? 'form-error' : '' }}" id="birthdate" name="birthdate" type="date"
							value="{{ date('Y-m-d', strtotime(old('birthdate', $users->birthdate ?? ''))) }}"
							placeholder="Masukan tanggal lahir">
					</div>
				</div>
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="address">Alamat</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address"
                            value="{{ old('address', $users->address ?? '') }}" placeholder="Masukan alamat"
                            class="{{ $errors->has('address') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				<div class="row">
					<div class="col-25">
						<label for="wilayah">Wilayah</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('wilayah') ? 'form-error' : '' }}" id="wilayah" name="wilayah" type="text"
							value="{{ old('wilayah', $users->wilayah ?? '') }}"
							placeholder="Masukan wilayah tempat tinggal anda  (Jelambar, Tj Duren, ...)">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="paroki">Paroki</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('paroki') ? 'form-error' : '' }}" id="paroki" name="paroki" type="text"
							value="{{ old('paroki', $users->paroki ?? '') }}" placeholder="Masukan paroki">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="social_instagram">Instagram</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('social_instagram') ? 'form-error' : '' }}" id="social_instagram"
							name="social_instagram" type="text" value="{{ old('social_instagram', $users->social_instagram ?? '') }}"
							placeholder="Masukan tag Instagram">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="social_tiktok">Tik Tok</label>
					</div>
					<div class="col-75">
						<input class="{{ $errors->has('social_tiktok') ? 'form-error' : '' }}" id="social_tiktok" name="social_tiktok"
							type="text" value="{{ old('social_tiktok', $users->social_tiktok ?? '') }}"
							placeholder="Masukan tag Tik Tok">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="gender">Gender</label>
					</div>
					<div class="col-75">
						<select class="{{ $errors->has('gender') ? 'form-error' : '' }}" id="gender" name="gender"
							value="{{ old('gender', $users->gender ?? '') }}" placeholder="Masukan gender">
							<option value="male" @selected($users->gender == 'male')>Male</option>
							<option value="female" @selected($users->gender == 'female')>Female</option>
						</select>
					</div>
				</div>
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="first_attendance">Pertama Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="first_attendance" name="first_attendance"
                            value="{{ date('Y-m-d', strtotime(old('first_attendance', $users->first_attendance ?? ''))) }}"
                            placeholder="Masukan tanggal kedatangan pertama kali"
                            class="{{ $errors->has('first_attendance') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="last_attendance">Terakhir Datang</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="last_attendance" name="last_attendance"
                            value="{{ date('Y-m-d', strtotime(old('last_attendance', $users->last_attendance ?? ''))) }}"
                            placeholder="Masukan tanggal kedatangan terakhir"
                            class="{{ $errors->has('last_attendance') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="total_attendance">Total Kedatangan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="total_attendance" name="total_attendance"
                            value="{{ old('total_attendance', $users->total_attendance ?? '') }}"
                            placeholder="Masukan total kedatangan"
                            class="{{ $errors->has('total_attendance') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="attendance_percentage">Persentase Kedatangan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="attendance_percentage" name="attendance_percentage"
                            value="{{ old('attendance_percentage', $users->attendance_percentage ?? '') }}"
                            placeholder="Masukan persentase kedatangan"
                            class="{{ $errors->has('attendance_percentage') ? 'form-error' : '' }}">
                    </div>
                </div> --}}
				{{-- <div class="row">
                    <div class="col-25">
                        <label for="description">Deskripsi</label>
                    </div>
                    <div class="col-75">
                        <textarea id="description" name="description" style="height:200px"
                            value="{{ old('description', $users->description ?? '') }}"></textarea>
                    </div>
                </div> --}}

				<div class="row submit-button-container">
					<input class="submit-button" type="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
@endsection

@section('js')
@endsection
