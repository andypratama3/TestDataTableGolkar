@extends('layouts.dashboard')
@section('title', 'Edit Kecamatan')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Edit Data</h5>

            <form class="row g-3" action="{{ route('dashboard.datamaster.kecamatan.store', $kecamatan->slug) }}"
                method="POST">
                @csrf
                <input type="hidden" name="slug" value="{{ $kecamatan->slug }}">
                <div class="col-12">
                    <label for="name" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control" id="name" name="name"
                        {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ $kecamatan->name }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Desa</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select select-desa" aria-label="Pilih Desa" name="desa[]">
                                    <option selected disabled>Pilih Desa</option>
                                    @foreach($desas as $desa)
                                    <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" id="dynamic-ar" class="btn btn-sm btn-primary"><i
                                        class="bi bi-plus"></i></button>
                            </td>
                        </tr>
                        @forelse ($kecamatan->desa as $key => $desa)
                        <tr>
                            <td>
                                <select class="form-select" aria-label="Pilih Desa" id="desa_select2{{ ++$key }}"
                                    name="desa[{{ $key }}]">
                                    <option value="{{ $desa->id }}" selected>{{ $desa->name }}</option>
                                    @foreach($desas as $desa_list)
                                    <option value="{{ $desa_list->id }}">{{ $desa_list->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-input-field"><i
                                        class="bi bi-trash"></i></button></td>
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
        <button type="submit" class="btn btn-primary">Ubah Data</button>
        <a href="{{ route('dashboard.datamaster.kecamatan.index') }}" class="btn btn-danger">Kembali</a>
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
                        <select class="form-select" aria-label="Pilih Desa" id="desa_select2${i}" name="desa[` + i + `]">
                            <option selected disabled>Pilih Desa</option>
                            @foreach($desas as $desa)
                            <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger remove-input-field"><i class="bi bi-trash"></i></button></td>
                    </td>
                </tr>`
            );
            $(`#desa_select2${i}`).select2();
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });

        $('.select-desa').select2();
    });
</script>
@endpush
@endsection
