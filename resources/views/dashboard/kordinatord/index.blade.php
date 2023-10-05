@extends('layouts.dashboard')
@section('title', 'Kordinator Desa')
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Kordinator Desa</h3>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kecamatans as $kecamatan)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $kecamatan->name }}</td>
                                <td><a href="{{ route('dashboard.input.kordinator.desa.name', $kecamatan->name) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a></td>
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
