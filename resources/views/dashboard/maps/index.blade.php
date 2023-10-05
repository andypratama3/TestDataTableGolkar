@extends('layouts.dashboard')
@section('title', 'Maps')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="form-group">
            <h2 class="text-center font-bold">Maps</h2>
            <div class="m-3">
                <div id="mapdashboard" style="height: 600px;"></div>
            </div>
        </div>
        <div class="form-group m-4">
        </div>
    </div>
</div>
@push('js')
{{-- <script src="{{ asset('assets_dashboard/js/jquery-3.6.0.min.js') }}"></script> --}}
{{-- @include('layouts.dashboard_partial.maps') --}}
{{-- <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script> --}}
{{-- <script>
    $(document).ready(function () {
        // maspDashboard();
        async function maspDashboard() {
            const { Map } = await google.maps.importLibrary("maps");

            // Initialize the map
            const map = new Map(document.getElementById("mapdashboard"), {
                center: { lat: -0.4939613021104909, lng: 117.12136581261049 },
                zoom: 12,
            });


            // const icons = '<i class = "ri-user-location-fill"</i>';
            const markersData = @json($pesertas);

            markersData.forEach((dataPeserta, i) => {
            // Get the label for this marker based on the current index

            if (dataPeserta.warna === 'kuning') {
                markerIcon = '{{ asset('assets_dashboard/mark/yellow.png') }}';
            } else if (dataPeserta.warna === 'abu-abu') {
                markerIcon = '{{ asset('assets_dashboard/mark/abu.png') }}';
            } else if (dataPeserta.warna === 'merah') {
                markerIcon = '{{ asset('assets_dashboard/mark/merah.png') }}';

            }
            const peserta = new google.maps.Marker({
                position: { lat: parseFloat(dataPeserta.latitude), lng: parseFloat(dataPeserta.longitude) },
                map: map,
                title: dataPeserta.name,

                icon: {
                    url: markerIcon, // Set the custom marker icon URL
                    scaledSize: new google.maps.Size(20, 30), // Adjust the size as needed
                },
            });

            const infowindow = new google.maps.InfoWindow({
                content: '<strong>Name:</strong> ' + dataPeserta.name +
                '<br><strong>Nik:</strong> ' + dataPeserta.nik +
                '<br>Memilih : </strong>' + dataPeserta.warna
                ,
                disableAutoPan: true,

            });

            peserta.addListener('click', () => {
                infowindow.open(map, peserta);
            });
        });
    const markerCluster = new markerClusterer.MarkerClusterer({ map, markersData });
    }
    // Call maspDashboard when the page loads
    window.onload = maspDashboard;
    });
</script> --}}
@endpush
@endsection
