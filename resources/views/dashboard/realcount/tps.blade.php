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
                </div>

                <div class="table-responsive p-3">
                    <table class="table table-flush " id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>TPS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($realcounts as $realcount)
                            <tr>
                                <td>{{ ++$no }}</td>
                                    @foreach ($realcount->tps_realcount as $tps)
                                    <td>{{ $tps->name }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.realcount.edit', $realcount->id) }}" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                                    </td>
                                    @endforeach
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
        $(".delete").on('click', function (e){
            slug = e.target.dataset.id;
            e.preventDefault();
            swal({
                    title: 'Anda yakin?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(`#delete-${slug}`).submit();
                    }else {
                        //do nothing
                    }
                });
        });
    });
</script>
@endpush
@endsection
