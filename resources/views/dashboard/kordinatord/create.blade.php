@extends('layouts.dashboard')
@section('title', 'Tambah')
@push('css')
<link href="{{ asset('assets_dashboard/css/select/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Tambah Data</h5>
            <form class="row g-3" action="{{ route('dashboard.kordinator.desa.store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="name" class="form-label">Nama Kordinator</label>
                    <input type="text" class="form-control" id="name" name="name"
                        {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Desa</label>
                        <select class="form-control select2" name="lokasi_desa" id="desa">
                            <option selected="selected">Pilih desa</option>
                            @foreach ($desas as $desa)
                            <option value="{{ $desa->name }}">{{ $desa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
        <div class="text-center mb-2">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        </form>
    </div>
</div>
@push('js')
<!-- Use -->
<script src="{{ asset('assets_dashboard/js/jquery-3.6.0.min.js') }}"></script>
<!-- Instead of -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="{{ asset('assets_dashboard/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        $('.select2').select2();
        $('#kecamatan').on('change', function (){
            let id_kecamatan = $('#kecamatan').val();
            $.ajax({
                type: "POST",
                url: "{{ route('get.desa') }}",
                data: {id_kecamatan: id_kecamatan},
                cache: false,
                success: function (response) {
                    $('#desa').html(response);
                },
                error: function($data){
                    console.log('error', $data);
                }
            });
        });
        $('#desa').on('change', function (){
            let id_desa = $('#desa').val();
            $.ajax({
                type: "POST",
                url: "{{ route('get.tps') }}",
                data: {id_desa: id_desa},
                cache: false,
                success: function (response) {
                    $('#tps').html(response);
                },
                error: function($data){
                    console.log('error', $data);
                }
            });
        });

    });

</script>
@endpush
@endsection
