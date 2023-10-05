@extends('layouts.dashboard')
@section('title', 'Kordinator Desa')
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Kordinator Desa Kecamatan {{ $name }}</h3>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Hp</th>
                                <th>Desa</th>
                                <th>Warna</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesertas as $peserta)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $peserta->name }}</td>
                                <td>{{ $peserta->nik }}</td>
                                <td>{{ $peserta->hp }}</td>
                                <td>
                                    @foreach ($peserta->desa_pesertas as $desa)
                                    {{ $desa->name }}
                                    @endforeach
                                <td>
                                    @if ($peserta->warna === 'kuning')
                                    <span class="badge bg-warning">{{ $peserta->warna }}</span>
                                    @elseif ($peserta->warna === 'merah')
                                    <span class="badge bg-danger">{{ $peserta->warna }}</span>
                                    @elseif ($peserta->warna === 'abu-abu')
                                    <span class="badge bg-secondary ">{{ $peserta->warna }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.input.peserta.show', $peserta->slug) }}"
                                        class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('dashboard.input.peserta.edit', $peserta->slug) }}"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                                    <a href="#" data-id="{{ $peserta->slug }}" class="btn btn-danger btn-sm delete"
                                        title="Hapus">
                                        <form action="{{ route('dashboard.input.peserta.destroy', $peserta->slug) }}"
                                            id="delete-{{ $peserta->slug }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <i class="bi bi-trash"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@push('js')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable
    });
</script>
@endpush
@endsection
