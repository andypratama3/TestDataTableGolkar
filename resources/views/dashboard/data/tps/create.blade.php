@extends('layouts.dashboard')
@section('title', 'Tambah tps')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Tambah Data</h5>
            {{-- @include('layouts.dashboard_partial.flashmessage') --}}
            <form class="row g-3" action="{{ route('dashboard.datamaster.tps.store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="name" class="form-label">Nama Tps</label>
                    <input type="text" class="form-control" id="name" name="name"
                        {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        </form>
    </div>
</div>

@endsection
