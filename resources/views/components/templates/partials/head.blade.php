<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <!-- Libs CSS -->
    <link href="{{ asset('dist/libs/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/selectize/dist/css/selectize.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/fullcalendar/core/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/fullcalendar/list/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/flatpickr/dist/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/libs/nouislider/distribute/nouislider.min.css') }}" rel="stylesheet" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.8.0/mapbox-gl.css" rel="stylesheet" />
    <!-- Tabler Core -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />

    <!-- Tabler Plugins -->
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-buttons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    {{-- <style> --}}
    {{-- body { --}}
    {{-- display: none; --}}
    {{-- } --}}
    {{-- </style> --}}
    @stack('extra-styles')
</head>
