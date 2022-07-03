@extends('layouts.app')

@section('content')
<div class="card mt-5 col-10 col-sm-6">
    <div class="card-body">
        <form action="{{ route('proporse.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">Nik</label>
                <input type="text" class="form-control" id="nik" name="nik" placeholder="Nik">
            </div>
            <div class="mb-3">
                <label for="kk" class="form-label">KK</label>
                <input type="text" class="form-control" id="kk" name="kk" placeholder="kk">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="nama">
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Provinsi</label>
                <input type="text" class="form-control" id="province" name="province" placeholder="Provinsi">
            </div>
            <div class="mb-3">
                <label for="regency" class="form-label">Kota/Kab</label>
                <input type="text" class="form-control" id="regency" name="regency" placeholder="Kota/Kab">
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Kecamatan">
            </div>
            <div class="mb-3">
                <label for="village" class="form-label">Desa</label>
                <input type="text" class="form-control" id="village" name="village" placeholder="Desa">
            </div>
            <select class="form-select" aria-label="Rw" name="rw">
                <option value="" selected>Pilih rw</option>
                @foreach ($rws as $rw)
                    <option value="{{ $rw->id }}">{{ $rw->name }}</option>
                @endforeach
            </select>
            <select class="form-select mt-3" aria-label="Rt" name="rt">
                <option value="" selected>Pilih rt</option>
                @foreach ($rts as $rt)
                    <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label for="address" class="form-label">Jalan</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Jalan">
            </div>
            <select class="form-select" aria-label="Pendapatan" name="income">
                <option value="" selected>Pilih pendapatan</option>
                @foreach ($incomes as $income)
                    <option value="{{ $income->id }}">{{ $income->name }}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label for="phone" class="form-label">No Hp</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="No Hp">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Swa foto dan Ktp</label>
                <input type="file" class="form-control" id="photo" name="photo" placeholder="Swa foto dan Ktp">
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" readonly>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" readonly>
            </div>
            <div id="map"></div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('extra-css')
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin="" />
        <style>
            #map {
                height: 500px;
            }

        </style>
    @endpush

    @push('extra-script')
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>

        <script>
            var map = L.map('map').fitWorld();

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1Ijoia2F3YW5rb2RpbmciLCJhIjoiY2t3cWg3aW1pMDY2MzJvbng5cWM5Y3V2aiJ9.3XUQum_yarzlylARjC3K-g'
            }).addTo(map);

            function onLocationFound(e) {
                var radius = e.accuracy;

                $('#latitude').val(e.latlng.lat)
                $('#longitude').val(e.latlng.lng)

                var locationMarker = L.marker(e.latlng, {
                    draggable: 'true'
                }).addTo(map);

                locationMarker.on('dragend', function(event) {
                    var marker = event.target;
                    var position = marker.getLatLng();

                    marker.setLatLng(position, {
                        draggable: 'true'
                    }).update()

                    $('#latitude').val(position.lat)
                    $('#longitude').val(position.lng)
                })
            }

            function onLocationError(e) {
                alert(e.message);
            }

            map.on('locationfound', onLocationFound);
            map.on('locationerror', onLocationError);
            map.locate({
                setView: true,
                maxZoom: 16
            });
        </script>
    @endpush
