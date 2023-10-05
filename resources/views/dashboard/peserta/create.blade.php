@extends('layouts.dashboard')
@section('title', 'Tambah Peserta')
@push('css')
<link href="{{ asset('assets_dashboard/css/select/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Tambah Data</h5>
            <form class="row g-3" action="{{ route('dashboard.input.peserta.store') }}" method="POST">
                @csrf
                <div class="col-6">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} " id="name"
                        name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="name" class="form-label" id="nik">NIK</label>
                        <input type="number" class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}"
                            id="inputnik" name="nik" value="{{ old('nik') }}" maxlength="16">
                        @if ($errors->has('nik'))
                        <div class="invalid-feedback">{{ $errors->first('nik') }}</div>
                        @endif
                        <div id="messageBisa" style="color: green; font-size: 13px;"></div>
                        <div id="messageNik" style="color: green; font-size: 13px;"></div>
                        <div id="messageTidak" style="color: red; font-size: 13px;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <label for="name" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control  {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}"
                        id="lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                    @if ($errors->has('tgl_lahir'))
                    <div class="invalid-feedback">{{ $errors->first('tgl_lahir') }}</div>
                    @endif
                </div>
                <div class="col-6">
                    <label for="name" class="form-label">Nomor hp</label>
                    <input type="number" class="form-control" id="hp" maxlength="13"
                        name="hp" value="{{ old('hp') }}">
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Kecamatan</label>
                        <select class="form-control select2 {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}"
                            name="kecamatan" id="kecamatan">
                            <option value="">Pilih Kecamatan</option>
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
                            id="desa">
                            {{ old('desa') }}
                        </select>
                        @if ($errors->has('desa'))
                        <div class="invalid-feedback">{{ $errors->first('desa') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label style="margin-bottom: 10px;">Tps</label>
                        <select class="form-control select2 {{ $errors->has('tps') ? 'is-invalid' : '' }}" name="tps"
                            id="tps" data-order-by="text">
                            {{ old('tps') }}
                        </select>
                        @if ($errors->has('tps'))
                        <div class="invalid-feedback">{{ $errors->first('tps') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <label for="name" class="form-label">Alamat</label>
                    <textarea name="alamat" id="" cols="10" rows="2"
                        class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}">{{ old('alamat') }}</textarea>
                    @if ($errors->has('alamat'))
                    <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                    @endif

                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Warna</label>
                        <select name="warna" id=""
                            class="form-control text-center {{ $errors->has('warna') ? 'is-invalid' : '' }}">
                            <option selected="selected" value="">Pilih Warna</option>
                            <option value="merah" style="background-color: red;">Merah (Tidak Meilih)</option>
                            <option value="abu-abu" style="background-color: gray;">Abu Abu (Ragu Ragu)</option>
                            <option value="kuning" style="background-color: yellow;">Kuning (Memilih)</option>

                        </select>
                        @if ($errors->has('warna'))
                        <div class="invalid-feedback">{{ $errors->first('warna') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id=""
                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                            <option disabled>Pilih Status</option>
                            <option value="relawan">Relawan</option>
                            <option value="simpatisan">Simpatisan</option>
                            <option value="kordinator_kecamatan">Kordinator Kecamatan</option>
                            <option value="kordinator_desa">Kordinator Desa</option>
                        </select>
                        @if ($errors->has('status'))
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Perekrut</label>
                        <input type="text" class="form-control" name="perekrut" id="perekrut" placeholder="Boleh Di kosongkan">
                        @if ($errors->has('perekrut'))
                            <div class="invalid-feedback">{{ $errors->first('perekrut') }}</div>
                        @endif
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-group text-center">
                        <label for=""><strong>Maps </strong></label>
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div> --}}
                {{-- <div class="form-group col-6 mt-3">
                    <label for="latitude">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" class="form-control">
            </div>
            <div class="form-group col-6 mt-3">
                <label for="longitude">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" class="form-control">
            </div> --}}

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
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#hp').on('input', function () {
            var hp = $(this).val();
            if (hp.length != 14) {
                $(this).val(nik.substring(0, 14));
            }
        });

        $('#inputnik').on('input', function () {
            var nik = $(this).val();
            if (nik.length != 16) {
                // Optionally, you can truncate the input value to 16 characters
                $(this).val(nik.substring(0, 16));
            }
        });
        $('#inputnik').on('change', function () {
            var nik = $(this).val();
            if (nik.length < 16) {
                // alert("Nik Tidak Boleh Kurang Atau Lebih Dari 16 Karakter");
                $('#messageNik').html("Nik Tidak Boleh Kurang Atau Dari 16 Karakter");
            } else {

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

                },
                error: function ($data) {
                    console.log('error', $data);
                }
            });
        });
        $('#desa').on('change', function () {
            let id_desa = $('#desa').val();
            $.ajax({
                type: "POST",
                url: "{{ route('get.tps') }}",
                data: {
                    id_desa: id_desa
                },
                cache: false,
                success: function (response) {
                    $('#tps').html(response);
                    // Setelah mengisi desa, reset elemen select TPS
                    //sorting data
                    // Sort the options alphabetically by their text (names)
                    // Sort the options based on the numeric portion of the text
                    var selectElement = document.getElementById("tps");
                    var options = Array.from(selectElement.options);

                    options.sort(function (a, b) {
                        var aNumber = parseInt(a.text.match(/\d+/));
                        var bNumber = parseInt(b.text.match(/\d+/));

                        return aNumber - bNumber;
                    });

                    // Clear the existing options
                    selectElement.innerHTML = "";

                    // Append the sorted options back to the select element
                    options.forEach(function (option) {
                        selectElement.appendChild(option);
                    });
                },
                error: function ($data) {
                    console.log('error', $data);
                }
            });
        });
        $('#inputnik').on('change', function () {
            let input_nik = $('#inputnik').val();
            $.ajax({
                type: "POST",
                url: "{{ route('get.nik') }}",
                data: {
                    input_nik: input_nik,
                },
                cache: false,
                success: function (response) {
                    if (response.hasOwnProperty('bisa')) {
                        $('#messageBisa').html(response.bisa);
                    } else {
                        $('#messageTidak').html(response.tidak);
                    }
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
