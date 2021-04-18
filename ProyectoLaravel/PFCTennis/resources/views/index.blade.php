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

    <div id="carouselIndicador" class="carousel slide" data-interval="5000" data-ride="carousel">
        <ol class="carousel-indicators">
        @foreach ($sliders as $obj)
            <li data-target="#carouselIndicador" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0  ? 'active' : '' }}"></li>
        @endforeach
        </ol>
        
        <div class="carousel-inner" role="listbox">
            @foreach ($sliders as $slider)
            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                <img style="width:100%;" src="imatges/{{ $slider->imatge }}">
                <div class="carousel-caption">
                    <h3>{{ $slider->titol }}</h3>
                    <p>{{ $slider->descripcio }}</p>
                </div>
            </div>
            @endforeach
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

    <!-- Consultar para poner las cartas de forma "elegante" -->
    <!-- https://stackoverflow.com/questions/39225608/bootstrap-flexbox-card-move-image-to-left-right-side-on-desktop -->
@endsection