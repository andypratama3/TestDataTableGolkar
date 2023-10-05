@extends('layouts.dashboard')
@section('title', 'Peserta Simpatisan')
@push('css')
<link href="{{ asset('assets_dashboard/css/select/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.2.0/css/scroller.dataTables.min.css">
@endpush
@section('content')
<section class="section">
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Peserta Simpatisan
                    </h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <a href="{{ route('dashboard.peserta.data.export.excel') }}"
                                    class="btn btn-sm btn-success text-center"><i
                                        class="bi bi-filetype-xls"></i> Export Excel</a>
                                <a href="{{ route('dashboard.peserta.data.export.pdf') }}"
                                    class="btn btn-sm btn-warning text-center"><i
                                        class="bi bi-filetype-pdf"></i> Export Pdf</a>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for=""><strong>Pilih Kecamatan </strong></label>
                                <select name="kecamatan" id="kecamatan" class="form-control select2">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for=""><strong>Pilih Desa</strong></label>
                                <select id="desa" class="form-control select2">
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for=""><strong>Tps</strong></label>
                                <select id="tps" class="form-control select2">
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr style="border: 2px solid">
                    <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush display nowrap" id="dataTable" style="font-size: 15px;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nik</th>
                                        <th>Hp</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Umur</th>
                                        <th>Alamat</th>
                                        <th>Warna</th>
                                        <th>Perekrut</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<input type="hidden" id="data-table" value="{{ route('dashboard.data_table.simpatisan') }}">
@push('js')
{{-- <script src="{{ asset('assets_dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.2.0/js/dataTables.scroller.min.js"></script>
<script src="{{ asset('assets_dashboard/js/select2.min.js')}}"></script>
<script>
    function reloadTable(id){
        var table = $(id).DataTable();
        table.cleanData;
        table.ajax.reload();
    }
$(document).ready(function () {
    $('#dataTable').DataTable({
        ordering: true,
        pagination: true,
        deferRender: true,
        serverSide: true,
        responsive: true,
        processing: true,
        pageLength: 50,
        ajax: {
                // let out = [];
                'url': $('#data-table').val(),
                'data': function (d) {
                    d.kecamatan = $('#kecamatan').val();
                    d.desa = $('#desa').val();
                    d.tps = $('#tps').val();
                }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'nik', name: 'nik' },
            { data: 'hp', name: 'hp' },
            { data: 'tgl_lahir', name: 'tgl_lahir' },
            { data: 'umur', name: 'umur' },
            { data: 'alamat', name: 'alamat', width: '10%' },
            {
                data: 'warna', name: 'warna',
                render: function (data, type, full, meta) {
                    if (data === 'kuning') {
                        return '<span class="badge bg-warning">' + data + '</span>';
                    } else if (data === 'abu-abu') {
                        return '<span class="badge bg-secondary">' + data + '</span>';
                    } else if (data === 'merah') {
                        return '<span class="badge bg-danger">' + data + '</span>';
                    } else {
                        return data;
                    }
                }
            },
            { data: 'perekrut', name: 'perekrut' },
            {
                data: 'options', name: 'options', orderable: false, searchable: false
            }
        ],
    });
    $('#dataTable').on('click', '#btn-delete', function () {
        var slug = $(this).data('id');
        var url = '{{ route("dashboard.input.peserta.destroy", ":slug") }}';
        url = url.replace(':slug', slug);
        swal({
            title: 'Anda yakin?',
            text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(url, { slug: slug }, function (data) {
                    if (data.status === 'success') {
                        swal('Berhasil', data.message, 'success').then(() => {
                        // Reload the page
                            window.location.href = "{{ route('dashboard.input.simpatisan.index') }}";
                        // Reload the page with a success message
                        });
                     } else {
                        // Reload the page with an error message
                         swal('Error', data.message, 'error');
                         window.location.href = "{{ route('dashboard.input.simpatisan.index') }}";
                     }
                });
            } else {
                // If the user cancels the deletion, do nothing
            }
        });
    });


    $('#kecamatan').on('change', function () {
        reloadTable('#dataTable');
    });
    $('#desa').change(function() {
        reloadTable('#dataTable');
    });
    $('#tps').change(function() {
        reloadTable('#dataTable');
    });

    $('.select2').select2();

    $('#kecamatan').on('change', function () {
        let id_kecamatan = $('#kecamatan').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
});
</script>


@endpush
@endsection
