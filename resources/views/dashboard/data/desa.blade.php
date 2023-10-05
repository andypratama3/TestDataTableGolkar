
@extends('layouts.dashboard')
@section('title', 'Desa')
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Desa</h3>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">Desa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kecamatans as $kecamatan)
                                @foreach ($kecamatan->desa as $desa)
                                    <tr>
                                        <td>{{ $desa->name }}</td>
                                        <td><a href="{{ route('dashboard.data.kecamatan.desa.tps', $desa->name) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a></td>
                                    </tr>
                                @endforeach
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
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
@endpush
@endsection
