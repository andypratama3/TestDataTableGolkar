@extends('layouts.dashboard')
@section('title', 'Edit')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Edit Kordinator Desa</h5>
            <form class="row g-3" action="{{ route('dashboard.kordinator.desa.update', $kordinatorD->slug) }}"
                method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="slug" value="{{ $kordinatorD->slug }}">
                <div class="col-12">
                    <label for="name" class="form-label">Nama kordinator</label>
                    <input type="text" class="form-control" id="name" name="name"
                        {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ $kordinatorD->name }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Desa</label>
                        <select class="form-control select2" name="lokasi_desa" id="desa">
                            <option selected="{{ $kordinatorD->lokasi_desa }}">{{ $kordinatorD->lokasi_desa }}
                            </option>
                            @foreach ($desas as $desa)
                            <option value="{{ $desa->name }}">{{ $desa->name }}</option>
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
