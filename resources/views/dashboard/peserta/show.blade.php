@extends('layouts.dashboard')
@section('title', 'Detail Desa')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Detail Data Peserta {{ $peserta->name }}</h5>
                <div class="col-sm-12">
                    <table class="table table-striped" id="dynamicAddRemove">
                        <tr>
                            <td>Nama          </td>
                            <td>:  {{ $peserta->name }}</td>
                        </tr>
                        <tr>
                            <td>Nik          </td>
                            <td>:  {{ $peserta->nik }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Hp          </td>
                            <td>:  {{ $peserta->hp }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir          </td>
                            <td>:  {{ $peserta->tgl_lahir }}</td>
                        </tr>
                        <tr>
                            <td>alamat          </td>
                            <td>:  {{ $peserta->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Kecamatan          </td>
                            @foreach ($peserta->kecamatan_pesertas as $kecamatan)
                            <td>:  {{ $kecamatan->name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Desa          </td>
                            @foreach ($peserta->desa_pesertas as $desa)
                            <td>:  {{ $desa->name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Tps          </td>
                            @foreach ($peserta->tps_pesertas as $tps)
                            <td>:  {{ $tps->name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Warna          </td>
                            <td>:  {{ $peserta->warna }}</td>
                        </tr>
                        <tr>
                            <td>Perekrut          </td>
                            <td>:  {{ $peserta->perekrut }}</td>
                        </tr>

                        <tr>
                            <td>Status          </td>
                            <td>:  {{ $peserta->status }}</td>
                        </tr>

                    </table>
                </div>
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route('dashboard.input.peserta.index') }}" type="reset" class="btn btn-danger">Kembali</a>
    </div>
    </form>
</div>
</div>

@endsection
