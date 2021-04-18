<!-- Llamamos al layout base -->
@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Index')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
    <link rel="stylesheet" href="{{ url('css/index.css') }}" >
@endpush

    <div id="carouselIndicador" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselIndicador" data-slide-to="0" class="active"></li>
            <li data-target="#carouselIndicador" data-slide-to="1"></li>
            <li data-target="#carouselIndicador" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="https://imagenes.heraldo.es/files/og_thumbnail/uploads/imagenes/2018/04/29/_berdascas20171023WA0006_ea870be2.jpg" style="width:100%;">
            </div>

            <div class="carousel-item">
                <img src="http://www.lasrosas.com.ar/portal/wp-content/uploads/Fognini-Schwartzman10-960x676.jpg" style="width:100%;">
            </div>

            <div class="carousel-item">
                <img src="https://educacionfisicaelrosario.files.wordpress.com/2014/06/baloncesto2-1.jpg" style="width:100%;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicador" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicador" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Següent</span>
        </a>
    </div>

@endsection