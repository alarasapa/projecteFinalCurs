<!-- Llamamos al layout base -->
@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Soci')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
    <link rel="stylesheet" href="{{ url('css/ClientEstils/soci.css') }}">
@push('scripts')
    <script src="{{ asset('js/ClientJS/soci.js') }}"></script>
    <script src="https://kit.fontawesome.com/037c3bf4d0.js" crossorigin="anonymous"></script>   
@endpush

<img src="imatges/soci/sociBanner.png" style="width: 100%"><br><br>

<div class="container">
    <div class="card">
        <div class="row">
            @foreach($tipusSocis as $tipus)
            <div class="col-md-3">
                <div class="mypricing_content clearfix">
                    <div class="mypricing_head_price clearfix">
                        <div class="mypricing_head_content clearfix">
                            <div class="head_bg"></div>
                            <div class="head"> <span>{{ $tipus->nom }}</span> </div>
                        </div>
                        <div class="mypricing_price_tag clearfix"> <span class="price"><span class="currency">{{ $tipus->preu }}</span><span class="sign">€</span><span class="cent"></span> <span class="month">/mes</span> </span> </div>
                    </div>
                    <div class="mypricing_feature_list">
                        <ul>
                            <li><span>{{ $tipus->descripcio }}</span></li>
                        </ul>
                    </div>
                    <div class="mypricing_price_btn clearfix"><a type="button" href="#"  data-toggle="modal" data-target="#modal-{{ $tipus->id }}">Apuntar-se</a> </div>
                </div>
            </div>

            <div class="modal fade" id="modal-{{ $tipus->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Apuntar-se a la tarifa {{ $tipus->nom }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Realitza el pagament de <strong>{{ $tipus->preu }}€</strong> al numero de Bizum següent: XXX-XXX-XXX
                        Una vegada fet, dona-li al botó d'enviar petició per a que sigui
                        confirmat per un dels nostres administradors.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                        @if (Auth::check())
                            <button type="button" style="color: white;" class="btn bg-danger" onclick="enviarPeticio( '{{ $tipus->id }}', '{{ Auth::user()->id }}')">Enviar petició</button>
                        @else
                            <button type="button" style="color: white;" class="btn bg-danger" onclick="location.href='/login'">Enviar petició</button>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="nostresServeis" class="container">
    <h2>ELS NOSTRES SERVEIS</h2>
    <br>
    <div class="row">
        <div class="col-md-3">
            <ul>
                <li><i class="fa fa-graduation-cap"></i> Escola</li><br>
                <li><i class="fas fa-swimmer"></i> Piscina</li><br>
                <li><i class="fas fa-dumbbell"></i> Gimnàs</li><br>
            </ul>
        </div>

        <div class="col-md-3">
            <ul>
                <li><i class="fas fa-utensils"></i> Bar / restaurant</li><br>
                <li><i class="fas fa-trophy"></i> Competicions per equips</li><br>
                <li><i class="far fa-smile"></i> Zona chill out</li><br>
                <li><i class="fas fa-child"></i> Zona infantil</li><br>
            </ul>
        </div>

        <div class="col-md-3">
            <ul>
                <li><i class="fas fa-parking"></i> Parking</li><br>
                <li><i class="fa fa-wifi"></i> Wifi</li><br>
                <li><i class="fas fa-umbrella-beach"></i> Casal d’estiu</li><br>
                <li><i class="fas fa-shopping-cart"></i> Servei de botiga</li><br>
            </ul>
        </div>

        <div class="col-md-3">
            <ul>
                <li>Servei d’encordat de raquetes</li><br>
                <li>Descomptes amb els nostres col·laboradors del club vela</li><br>
                <li><img width="200" src="imatges/soci/clubVela.jpg"></li>
            </ul>
        </div>
    </div>
</div>

@endsection