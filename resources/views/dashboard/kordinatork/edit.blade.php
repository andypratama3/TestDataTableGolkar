@extends('layouts.dashboard')
@section('title', 'Edit')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Edit Kordinator</h5>
            <form class="row g-3" action="{{ route('dashboard.kordinator.kecamatan.update', $kordinatork->slug) }}"
                method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="slug" value="{{ $kordinatork->slug }}">
                <div class="col-12">
                    <label for="name" class="form-label">Nama kordinator</label>
                    <input type="text" class="form-control" id="name" name="name"
                        {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ $kordinatork->name }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Kecamatan</label>
                        <select class="form-control select2" name="lokasi_kecamatan" id="kecamatan">
                            <option selected="{{ $kordinatork->lokasi_kecamatan }}">{{ $kordinatork->lokasi_kecamatan }}
                            </option>
                            @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->name }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Ubah Data</button>
            <a href="{{ route('dashboard.kordinator.kecamatan.index') }}" class="btn btn-danger">Kembali</a>
        </div>
        </form>
    </div>
</div>

@endsection
