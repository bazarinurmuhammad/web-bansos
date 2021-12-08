<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="{{ asset('dist/libs/jquery/dist/jquery.slim.min.js') }}"></script> --}}
<script src="{{ asset('dist/libs/peity/jquery.peity.min.js') }}"></script>
<!-- Tabler Core -->
<script src="{{ asset('dist/js/tabler.min.js') }}"></script>

<script>
    $('#logout').click(function(e) {
        console.log('test')
        e.preventDefault()
        $.ajax({
            type: 'POST',
            url: 'logout',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(response) {
                window.location.href = '/'
            },
        })
    })
</script>

@stack('extra-scripts')

<script>
    document.body.style.display = "block"
</script>
