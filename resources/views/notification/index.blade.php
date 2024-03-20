@extends('master')

@section('title')
@endsection

@section('css')
	@parent
@endsection

@section('navbar')
	@parent
@endsection

@section('content')
	@if (auth()->user()->isAdmin())
		@forelse($notifications as $notification)
			<div class="alert alert-success" role="alert">
				@foreach ($notification->data as $nama)
					@if (!$loop->first)
						&
					@endif
					{{ $nama }}
				@endforeach
				berulang tahun pada
				{{ Carbon\Carbon::parse($notification->created_at)->format('d M Y') ?? null }}
				<a class="ml-20" href="{{ url("notification/read/$notification->id") }}">
					<button class="solid-button-button button Button">Mark as read</button>
				</a>
			</div>

			@if ($loop->last)
				<a id="mark-all" href="{{ route('notification.readall') }}">
					<button class="solid-button-button button Button">Mark all as read</button>
				</a>
			@endif
		@empty
			There are no new notifications
		@endforelse
	@endif
@endsection

@section('js')
@endsection
