<!-- Llamamos al layout base -->
@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Reservar')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}">
    <link rel="stylesheet" href="{{ url('css/ClientEstils/reservar.css') }}">
@endpush

<img src="../imatges/reserva/reservaBanner.jpg" style="width: 100%; height: 400px;"><br><br>

<div class="conainer">
    <div class="row">
        <div class="col-md-6">
            <img id="cartellHorari" src="../imatges/reserva/reservaBanner.jpg" style="width: 100%; height: 400px;"><br><br>
        </div>
        <div class="col-md-6">
            <img id="cartellPreu" src="../imatges/reserva/reservaBanner.jpg" style="width: 100%; height: 400px;"><br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>RESERVAR PISTA DE TENNIS</h3>
            <a class="btn bg-danger" href="https://playtomic.io/tennis-blanes/745f469e-c8bd-4aa6-b427-90b080b53058?q=TENNIS~2021-05-02~~~">Reservar a PlayTomic</a>
        </div>
        <div class="col-md-6">
            <h3>RESERVAR PISTA DE PÀDEL</h3>
            <a class="btn bg-danger" href="https://playtomic.io/tennis-blanes/745f469e-c8bd-4aa6-b427-90b080b53058?q=PADEL~2021-05-02~~~">Reservar a PlayTomic</a>
        </div>
        
        <div id="whatsapp" class="col-md-12">
            <!-- <a href="#">Enviar-nos un email</a> -->
            <p>Enviar missatge per WhatsApp: +34 123 45 67 89 <i class="fa fa-whatsapp" aria-hidden="true"></i></p>
        </div>
    </div>
</div>

@endsection