@extends('layouts.dashboard')
@section('title', 'Tambah Desa')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Tambah Data</h5>
            <form class="row g-3" action="{{ route('dashboard.datamaster.desa.update', $desa->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ $desa->slug }}" name="slug">
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
                                <th>TPS</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-select select-tps" aria-label="Pilih Tps" name="tps[]">
                                        <option selected disabled>Pilih Tps</option>
                                        @foreach($tpss as $tps)
                                        <option value="{{ $tps->id }}">{{ $tps->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" id="dynamic-ar" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></button>
                                </td>
                            </tr>
                            @forelse ($desa->tps as $key => $tps)
                            <tr>
                                <td>
                                    <select class="form-select" aria-label="Pilih Tps" id="tps_select2_{{ ++$key }}" name="tps[{{ $key }}]">
                                        <option value="{{ $tps->id }}" selected>{{ $tps->name }}</option>
                                        @foreach($tpss as $tps_list)
                                        <option value="{{ $tps_list->id }}">{{ $tps_list->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-input-field"><i class="bi bi-trash"></i></button></td>
                                </td>
                            </tr>
                            @empty
                                <td>Tidak Ada Tps </td>
                            @endforelse
                        </table>
                    </div>
                </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        </form>
    </div>
</div>


@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append(
                `<tr>
                    <td>
                        <select class="form-select" aria-label="Pilih Tps" id="tps_select2_${i}" name="tps[` + i + `]">
                            <option selected disabled>Pilih Tps</option>
                            @foreach($tpss as $tps)
                            <option value="{{ $tps->id }}">{{ $tps->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger remove-input-field"><i class="bi bi-trash"></i></button></td>
                    </td>
                </tr>`
            );
            $(`#tps_select2_${i}`).select2();
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });

        $('.select-tps').select2();
    });
</script>
@endpush
@endsection
