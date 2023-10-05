@extends('layouts.dashboard')
@section('title', 'Tps')
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Tps</h3>
                    <a href="{{ route('dashboard.datamaster.tps.create') }}" class="btn btn-sm btn-primary" style="float: right;">Tambah Data</a>

                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Tps</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tpss as $tps)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $tps->name }}</td>

                                <td>
                                    <a href="{{ route('dashboard.datamaster.tps.edit', $tps->slug) }}" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                                    <a href="#" data-id="{{ $tps->slug }}" class="btn btn-danger delete" title="Hapus">
                                        <form action="{{ route('dashboard.datamaster.tps.destroy', $tps->slug) }}"
                                            id="delete-{{ $tps->slug }}" method="POST" enctype="multipart/form-data">
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
@endsection
