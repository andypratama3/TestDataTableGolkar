
@extends('layouts.dashboard')
@section('title', 'DPT')
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">DPT</h3>
                    <a href="{{ route('dashboard.dpt.create') }}" class="btn btn-sm btn-primary" style="float: right;">Tambah Data</a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($dpts as $dpt)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $dpt->name }}</td>
                                <td>{{ $dpt->file }}</td>
                                <td>
                                    <a href="{{ asset('storage/file/dpt/'.$dpt->file)}}" class="btn btn-sm btn-warning"><i class="bi bi-download"></i></a>
                                    <a href="#" data-id="{{ $dpt->slug }}" class="btn btn-danger btn-sm delete" title="Hapus">
                                        <form action="{{ route('dashboard.dpt.destroy', $dpt->slug) }}"
                                            id="delete-{{ $dpt->slug }}" method="POST" enctype="multipart/form-data">
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
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
@endpush
@endsection
