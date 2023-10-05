@extends('layouts.dashboard')
@section('title', 'Tambah Peserta')
@push('css')
<link href="{{ asset('assets_dashboard/css/select/select2.min.css') }}" rel="stylesheet" />
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Update Real Count</h5>
            <form class="row g-3" action="{{ route('dashboard.realcount.update', $realcount->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $realcount->id }}">
                <div class="col-6">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Kecamatan</label>
                        <select class="form-control select2 {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}"
                            name="kecamatan" id="kecamatan">
                            @foreach ($realcount->kecamatan_realcount as $kecamatan)
                            <option value="{{$kecamatan->id}}">{{$kecamatan->name}}</option>
                            @endforeach
                            @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}"
                                {{ old('kecamatan') == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('kecamatan'))
                        <div class="invalid-feedback">{{ $errors->first('kecamatan') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Desa</label>
                        <select class="form-control select2 {{ $errors->has('desa') ? 'is-invalid' : '' }}" name="desa"
                            id="desa" {{ old('desa') }}>
                            @foreach ($realcount->desa_realcount as $desa)
                            <option value="{{$desa->id}}">{{$desa->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('desa'))
                        <div class="invalid-feedback">{{ $errors->first('desa') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Tps</label>
                        <select class="form-control select2 {{ $errors->has('tps') ? 'is-invalid' : '' }}" name="tps" id="tps"
                            data-order-by="text" {{ old('tps') }}>
                            @foreach ($realcount->tps_realcount as $tps)
                            <option value="{{$tps->id}}">{{$tps->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tps'))
                        <div class="invalid-feedback">{{ $errors->first('tps') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Total Suara</label>
                        <input type="text" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"
                            name="total" value="{{ $realcount->total }}">
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
<script src="{{ asset('assets_dashboard/js/select2.min.js')}}"></script>
<!-- Bagian JavaScript di dalam Blade View -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2();

        $('#kecamatan').on('change', function () {
            let id_kecamatan = $('#kecamatan').val();
            $.ajax({
                type: "POST",
                url: "{{ route('get.desa') }}",
                data: {
                    id_kecamatan: id_kecamatan
                },
                cache: false,
                success: function (response) {
                    $('#desa').html(response);
                    $('#desa').attr('value', response);

                    // Setelah mengisi desa, reset elemen select TPS
                    $('#tps').html('<option value="">Pilih TPS</option>');
                },
                error: function ($data) {
                    console.log('error', $data);
                }
            });
        });

        $('#desa').on('change', function () {
            let id_desa = $('#desa').val();
            // $.ajax({
            //     type: "POST",
            //     url: "{{ route('realcount.get.tps') }}",
            //     data: {
            //         id_desa: id_desa
            //     },
            //     cache: false,
            //    success: function (response) {
            //             // Dapatkan elemen select dengan id "tps"
            //             var selectElement = document.getElementById("tps");

            //             // Hapus semua opsi yang ada sebelumnya
            //             selectElement.innerHTML = "";

            //             // Loop melalui opsi TPS dalam respons JSON
            //             for (var tpsId in response.tpsExists) {
            //                 if (response.tpsExists.hasOwnProperty(tpsId) && !response.tpsExists[tpsId]) {
            //                     // Jika tpsExists[tpsId] adalah false, tambahkan sebagai opsi
            //                     var optionElement = document.createElement("option");
            //                     optionElement.value = tpsId;
            //                     optionElement.textContent = response.options[tpsId];
            //                     selectElement.appendChild(optionElement);
            //                 }
            //             }
            //         },
            //     error: function ($data) {
            //         console.log('error', $data);
            //     }
            // });
            $.ajax({
                type: "POST",
                url: "{{ route('realcount.get.tps') }}",
                data: {
                    id_desa: id_desa
                },
                cache: false,
                success: function (response) {
                    var selectElement = document.getElementById("tps");
                    // Hapus semua opsi yang ada sebelumnya
                    selectElement.innerHTML = "";
                    // Tambahkan opsi HTML dari respons JSON
                    selectElement.innerHTML = response.options;
                    // Refresh Select2 agar pilihan-pilihan yang baru ditambahkan dapat dilihat
                    selectElement.trigger('change');
                },
                error: function ($data) {
                    console.log('error', $data);
                }
            });
        });
    });
</script>


@endpush
@endsection
