<!-- Llamamos al layout base -->
@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Escola')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
@endpush

<img src="../imatges/escola/escolaBanner.jpg" style="width: 100%; height: 400px; object-fit: cover;"><br><br>

<div class="conainer">
    
</div>


@endsection