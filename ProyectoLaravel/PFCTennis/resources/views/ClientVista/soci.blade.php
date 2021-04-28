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
    <script src="https://kit.fontawesome.com/037c3bf4d0.js" crossorigin="anonymous"></script>   
@endpush

<!-- TODO CAMBIAR RUTAS PARA HACER EL usuari.* Y QUE SALGA ACTIVE TODO -->

<img src="imatges/soci/sociBanner.png" style="width: 100%"><br><br>

<div class="container">
    <div class="card">
        <div class="row">
            <div class="col-md-3">
                <div class="mypricing_content clearfix">
                    <div class="mypricing_head_price clearfix">
                        <div class="mypricing_head_content clearfix">
                            <div class="head_bg"></div>
                            <div class="head"> <span>Familiar</span> </div>
                        </div>
                        <div class="mypricing_price_tag clearfix"> <span class="price"><span class="currency">65</span><span class="sign">€</span><span class="cent"></span> <span class="month">/mes</span> </span> </div>
                    </div>
                    <div class="mypricing_feature_list">
                        <ul>
                            <li><span>Piscina</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Gimnàs</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Partits</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Tennis</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Pàdel</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Per a la familia</span></li>
                        </ul>
                    </div>
                    <div class="mypricing_price_btn clearfix"> <a class="" href="#">Apuntar-se</a> </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mypricing_content clearfix">
                    <div class="mypricing_head_price clearfix">
                        <div class="mypricing_head_content clearfix">
                            <div class="head_bg"></div>
                            <div class="head"> <span>Individual (Full)</span> </div>
                        </div>
                        <div class="mypricing_price_tag clearfix"> <span class="price"><span class="currency">35</span><span class="sign">€</span><span class="cent"></span> <span class="month">/mes</span> </span> </div>
                    </div>
                    <div class="mypricing_feature_list">
                        <ul>
                            <li><span>Piscina</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Gimnàs</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Partits</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Tennis</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Pàdel</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Pots jugar tennis i pàdel</span></li>
                        </ul>
                    </div>
                    <div class="mypricing_price_btn clearfix"> <a class="" href="#">Apuntar-se</a> </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mypricing_content clearfix">
                    <div class="mypricing_head_price clearfix">
                        <div class="mypricing_head_content clearfix">
                            <div class="head_bg"></div>
                            <div class="head"> <span>Individual (Parcial)</span> </div>
                        </div>
                        <div class="mypricing_price_tag clearfix"> <span class="price"><span class="currency">35</span><span class="sign">€</span><span class="cent"></span> <span class="month">/mes</span> </span> </div>
                    </div>
                    <div class="mypricing_feature_list">
                        <ul>
                            <li><span>Piscina</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Gimnàs</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Partits</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Tennis</span> <i class="fa fa-check" aria-hidden="true"></i> o <i class="fa fa-times" aria-hidden="true"></i></li>
                            <li><span>Pàdel</span> <i class="fa fa-check" aria-hidden="true"></i> o <i class="fa fa-times" aria-hidden="true"></i></li>
                            <li><span>Escollir Tennis o Pàdel</span></li>
                        </ul>
                    </div>
                    <div class="mypricing_price_btn clearfix"> <a class="" href="#">Apuntar-se</a> </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="mypricing_content clearfix">
                    <div class="mypricing_head_price clearfix">
                        <div class="mypricing_head_content clearfix">
                            <div class="head_bg"></div>
                            <div class="head"> <span>Infantil</span> </div>
                        </div>
                        <div class="mypricing_price_tag clearfix"> <span class="price"><span class="currency">35</span><span class="sign">€</span><span class="cent"></span> <span class="month">/mes</span> </span> </div>
                    </div>
                    <div class="mypricing_feature_list">
                        <ul>
                            <li><span>Piscina</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Gimnàs</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Partits</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Tennis</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Pàdel</span> <i class="fa fa-check" aria-hidden="true"></i></li>
                            <li><span>Fins a 16 anys</span></li>
                        </ul>
                    </div>
                    <div class="mypricing_price_btn clearfix"> <a class="" href="#">Apuntar-se</a> </div>
                </div>          
            </div>
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
                <li>Descomptes amb els nostres col·laboradors</li><br>
            </ul>
        </div>
    </div>
</div>


@endsection