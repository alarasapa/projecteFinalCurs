@extends('layouts.base')

<!-- Introducimos el contenido y le pasamos el tiutlo de la página como parámetro -->
@section('content')
@section('titol', 'Peticio Enviada')

<!-- Introducimos los CSS deseados -->
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
    <link rel="stylesheet" href="{{ url('css/ClientEstils/peticioEnviada.css') }}" >
@endpush

<div class="conainer">
    <div class="row justify-contents-center mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <h4 style="text-align: center; text-decoration: underline;" class="card-header">Has enviat una petició per: <strong>{{ $activitat }}</strong></h4>
                <div class="card-body">
                    <p class="card-text">Has enviat la petició pero has de pagar per Bizum per a poder gaudir dels beneficis.</p>
                    <p class="card-text">També pots enviar missatge per WhatsApp: +34 123 45 67 89 <i class="fa fa-whatsapp" aria-hidden="true"></i></p>

                    <a href="{{ route('soci') }}" class="card-link">Fes-te soci per a millors preus</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection