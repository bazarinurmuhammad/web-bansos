@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <h1 class="text-center">SISTEM INFORMASI GEOGRAFIS</h1>
        <H1 class="text-center">PEMETAAN PENERIMA BANTUAN SOSIAL KELURAHAN KARAMAT </H1>
        <div id="map"></div>

        <div class="d-flex justify-content-between">
            <a href="{{ url('/proporser') }}" class="btn btn-success">Ajukan Bantuan</a>
            <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
        </div>
    </div>
</div>
@endsection
