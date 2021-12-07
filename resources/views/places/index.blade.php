<x-templates.default>
    <x-slot name="title">Data Tempat Kuliner</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('place.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kecamatan</th>
                    <th>Deskripsi</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Tindakan</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @push('extra-styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    @endpush

    @push('extra-scripts')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

        <script>
            $(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('place.index') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'subDistrictName', name: 'subDistrictName' },
                        { data: 'description', name: 'description' },
                        { data: 'address', name: 'address' },
                        { data: 'phone', name: 'phone' },
                        { data: 'action', name: 'action' }
                    ]
                });
            });
        </script>
    @endpush
</x-templates.default>
