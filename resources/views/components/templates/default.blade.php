<!doctype html>
<html lang="en">

@include('components.templates.partials.head')

<body class="antialiased">

    @include('components.templates.partials.sidebar')

    <div class="page">
        <div class="content">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h2 class="page-title">
                                {{ $title ?? 'Dashboard' }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row row-deck row-cards">
                    <x-forms.alert />
                    {{ $slot }}
                </div>
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Logout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to end this session?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="logout">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.templates.partials.footer')
        </div>
    </div>
    <!-- Libs JS -->
    @include('components.templates.partials.scripts')
</body>

</html>
