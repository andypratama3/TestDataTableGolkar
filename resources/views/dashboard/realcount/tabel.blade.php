@extends('layouts.dashboard')
@section('title', 'Table Realcount')
@push('css')
<link href="{{ asset('assets_dashboard/css/select/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Table Realcount
                    </h3>
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
                        <tbody id="dataTable">
                            @foreach ($kecamatans as $kecamatan)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $kecamatan->name }}</td>
                                <td><a href="{{ route('dashboard.table.realcount.kecamatan', $kecamatan->name) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@push('js')
<script src="{{ asset('assets_dashboard/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets_dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        let dataTable = $('#dataTable').DataTable()
    });
</script>
@endpush
@endsection
