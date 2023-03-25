@extends('master')

@section('title')
    Tema PD - Edit
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
                        <input type="text" id="title" name="title" value="{{ old('title', $TemaPd->title ?? '') }}"
                            placeholder="Masukan nama kegiatan" class="{{ $errors->has('title') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="date">Tanggal Kegiatan</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="date" name="date"
                            value="{{ date('Y-m-d', strtotime(old('date', $TemaPd->date ?? ''))) }}"
                            placeholder="Masukan tanggal kegiatan" class="{{ $errors->has('date') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="media">Media</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="media" name="media" value="{{ old('media', $TemaPd->media ?? '') }}"
                            placeholder="Masukan url media" class="{{ $errors->has('media') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="links">Links</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="links" name="links"
                            value="{{ old('links', $TemaPd->links ?? '') }}" placeholder="Masukan url kegiatan"
                            class="{{ $errors->has('links') ? 'form-error' : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="active">Active</label>
                    </div>
                    <div class="col-75">
                        <select name="active" id="active" value="{{ old('active', $TemaPd->active ?? '') }}"
                            placeholder="Masukan active" class="{{ $errors->has('active') ? 'form-error' : '' }}">
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
                    <input type="submit" value="Submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
