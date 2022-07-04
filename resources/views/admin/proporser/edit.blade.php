<x-templates.default>
    <x-slot name="title">Edit pengajuan Bantuan</x-slot>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Edit Data pengajuan Bantuan</h1>
            </div>

            <div class="card-body">
                <form action="{{ url('/manage-proporser/'.$proporser->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row row-cols-sm-2 row-cols-1">
                        <div class="col">
                            @include('components.forms.input', ['label' => 'nomor kk', 'name' => 'kk', 'required' => true, 'value' => $proporser->kk])
                        </div>
                        <div class="col">
                            @include('components.forms.input', ['label' => 'nomor nik', 'name' => 'nik', 'required' => true, 'value' => $proporser->nik])
                        </div>
                    </div>
                    <div class="row row-cols-sm-2 row-cols-1">
                        <div class="col">
                            @include('components.forms.input', ['label' => 'nama', 'name' => 'name', 'required' => true, 'value' => $proporser->name])
                        </div>
                        <div class="col">
                            @include('components.forms.input', ['label' => 'provinsi', 'name' => 'province', 'required' => true, 'value' => $proporser->province])
                        </div>
                    </div>
                    <div class="row row-cols-sm-2 row-cols-1">
                        <div class="col">
                            @include('components.forms.input', ['label' => 'kota/kab', 'name' => 'regency', 'required' => true, 'value' => $proporser->regency])
                        </div>
                        <div class="col">
                            @include('components.forms.input', ['label' => 'kecamatan', 'name' => 'district', 'required' => true, 'value' => $proporser->district])
                        </div>
                    </div>
                    @include('components.forms.input', ['label' => 'desa', 'name' => 'village', 'required' => true, 'value' => $proporser->village])

                    <div class="row row-cols-sm-2 row-cols-1 mb-3">
                        <div class="col">
                        <select class="form-select @error('rw') is-invalid @enderror" aria-label="Rw" name="rw">
                            <option value="" selected>Pilih rw</option>
                            @foreach ($rws as $rw)
                            <option value="{{ $rw->id }}" {{ old('rw', $proporser->rw_id) == $rw->id ? 'selected' : '' }}>{{ $rw->name }}</option>
                            @endforeach
                        </select>
                        @error('rw')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col">
                            <select class="form-select @error('rt') is-invalid @enderror" aria-label="Rt" name="rt">
                                <option value="" selected>Pilih rt</option>
                                @foreach ($rts as $rt)
                                <option value="{{ $rt->id }}" {{ old('rt', $proporser->rt_id) == $rt->id ? 'selected' : '' }}>{{ $rt->name }}</option>
                                @endforeach
                            </select>
                            @error('rt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @include('components.forms.input', ['label' => 'jalan', 'name'=> 'address', 'required' => true, 'value' => $proporser->address])

                    <select class="form-select @error('income') is-invalid @enderror" aria-label="Pendapatan" name="income">
                        <option value="" selected>Pilih income</option>
                        @foreach ($incomes as $income)
                        <option value="{{ $income->id }}" {{ old('income', $proporser->income_id) == $income->id ? 'selected' : '' }}>{{ $income->name }}</option>
                        @endforeach
                    </select>
                    @error('income')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="row row-cols-sm-2 row-cols-1 mb-3">
                        <div class="col">  
                            @include('components.forms.input', ['label' => 'No HP', 'name' => 'phone', 'required' => true, 'value' => $proporser->phone]) 
                        </div>
                        <div class="col">
                            @include('components.forms.input', ['label' => 'Swa foto dan Ktp', 'name' => 'photo', 'required' => true, 'type' => 'file']) 
                        </div>
                    </div>

                    <span><strong>Status</strong></span>
                    <select class="form-select @error('status') is-invalid @enderror" aria-label="Pendapatan" name="status">
                        <option value="" disabled selected>Pilih status</option>
                        <option value="pending" {{ old('status', $proporser->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ old('status', $proporser->status) == 'diterima' ? 'selected' : '' }}>di terima</option>
                        <option value="ditolak" {{ old('status', $proporser->status) == 'ditolak' ? 'selected' : '' }}>di tolak</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <img src="{{ asset($proporser->photo) }}" alt="swa foto dan ktp" class="img-fluid">

                    <div class="row row-cols-sm-2 row-cols-1 my-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" readonly>
                        </div>
                    </div>
                    </div>
                    <div id="map"></div>


                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    @push('extra-styles')
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

    @push('extra-scripts')
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>

        <script>
            var map = L.map('map').setView([{{ $proporser->latitude }}, {{ $proporser->longitude }}], 16);

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

</x-templates.default>