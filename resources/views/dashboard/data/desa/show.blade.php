@extends('layouts.dashboard')
@section('title', 'Detail Desa')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Detail Data</h5>
            <form class="row g-3">
                @csrf
                <div class="col-12">
                    <label for="name" class="form-label">Nama Desa</label>
                    <input type="text" class="form-control" id="name" name="name"
                        {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ $desa->name }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th class="text-center">TPS</th>
                        </tr>
                        <tr>
                            <td>
                                @forelse ($desa->tps as $tps)
                                <h6>{{ $tps->name }}</h6>
                                @empty
                                <h6>Belum Ada Tps</h6>
                                @endforelse
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route('dashboard.datamaster.desa.index') }}" type="reset" class="btn btn-danger">Kembali</a>
    </div>
    </form>
</div>
</div>

@endsection
