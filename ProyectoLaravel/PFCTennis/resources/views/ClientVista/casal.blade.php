<!-- Llamamos al layout base -->
@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Casal')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
@endpush

<h1>AAAAAAAAAAAAAAAAAAAAAAA</h1>

@endsection