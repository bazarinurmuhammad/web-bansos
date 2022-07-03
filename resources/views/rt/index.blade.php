<x-templates.default>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('rt.create') }}" class="btn btn-primary">Tambah RT</a>
            </div>

            <div class="card-body">
                <div class="">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <td>Tindakan</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-danger" data-id="" id="confirmDelete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('extra-styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    @endpush

    @push('extra-scripts')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

        <script>
            $(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('rt.index') !!}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            });

            $('#dataTable').on('click', 'a#delete', function(e) {
                e.preventDefault()
                var id = $(this).data('id')
                $('#confirmDelete').attr('data-id', id)
                $('#deleteModal').modal('show')
            })

            $('#confirmDelete').click(function(e) {
                e.preventDefault()
                var id = $(this).data('id')

                $.ajax({
                    type: 'DELETE',
                    url: 'rt/' + id,
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = ''
                        }
                    },
                })
            })
        </script>

    @endpush

    <x-slot name="title">Data rt</x-slot>
</x-templates.default>
