@extends('layouts.dashboard')
@section('title','Dashboard')
@section('content')
<div class="pagetitle">
    <h1 class="text-black">Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Home</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chart Pemilih / Pendukung</h5>
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
</section>

@push('js')
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
        $('#dataTableHover').DataTable();
    });
</script>
@endpush
@endsection
