@extends('layouts.dashboard')
@section('title', 'RealCount')
@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chart Realcount</h5>
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
</section>

@push('js')
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@endpush
@endsection
