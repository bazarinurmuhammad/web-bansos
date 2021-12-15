<x-templates.default>
    <x-slot name="title">Edit Menu</x-slot>

    <form action="{{ route('menu.update', [$place, $menu]) }}" class="card" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-header">
            <h1 class="card-title">Tambah Data Menu</h1>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Masukkan nama menu" value="{{ old('name') ?? $menu->name }}">

                @error('name')
                <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="">Deskripsi</label>
                <textarea name="description" id="" rows="3"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Deskripsi menu">{{ old('description') ?? $menu->description }}</textarea>

                @error('description')
                <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="">Kategori</label>
                <select name="category_id" id=""
                        class="form-control @error('category_id') is-invalid @enderror">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $menu->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="">Foto</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                       placeholder="Masukkan foto" value="{{ old('image') }}">

                @error('image')
                <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Harga</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                       placeholder="Masukkan harga menu" value="{{ old('price') ?? $menu->price }}">

                @error('price')
                <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" value="Simpan" class="btn btn-primary float-right">
        </div>
    </form>

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
</x-templates.default>