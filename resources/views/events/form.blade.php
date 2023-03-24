@extends('master')

@section('title')
    Kegiatan PD - Edit
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/events/form.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div id="main-section" class="home-main">
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
            <form method="POST" action="/events/update/{{ $events->id }}">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-25">
                        <label for="name">Nama Kegiatan</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" name="name" value="{{ old('name', $events->name ?? '') }}"
                            placeholder="Masukan nama kegiatan" class="{{ $errors->has('name') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="date">Tanggal Lahir</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="date" name="date"
                            value="{{ date('Y-m-d', strtotime(old('date', $events->date ?? ''))) }}"
                            placeholder="Masukan tanggal kegiatan" class="{{ $errors->has('date') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="media">Media</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="media" name="media" value="{{ old('media', $events->media ?? '') }}"
                            placeholder="Masukan url media" class="{{ $errors->has('media') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="links">Links</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="links" name="links"
                            value="{{ old('links', $events->links ?? '') }}" placeholder="Masukan url kegiatan"
                            class="{{ $errors->has('links') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="order_number">Order Number</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="order_number" name="order_number"
                            value="{{ old('order_number', $events->order_number ?? '') }}"
                            placeholder="Masukan order number untuk di tampilkan"
                            class="{{ $errors->has('order_number') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="active">Active</label>
                    </div>
                    <div class="col-75">
                        <select name="active" id="active" value="{{ old('active', $events->active ?? '') }}"
                            placeholder="Masukan active" class="{{ $errors->has('active') ? 'form-error' : '' }}">
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
                    <input type="submit" value="Submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
