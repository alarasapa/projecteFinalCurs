<!-- Llamamos al layout base -->
@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Soci')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
    <link rel="stylesheet" href="{{ url('css/ClientEstils/soci.css') }}">
@endpush

<div class="container">

    <!-- TODO IMAGEN PARA TRANSICIONAR A LAS CARTAS -->

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

@endsection