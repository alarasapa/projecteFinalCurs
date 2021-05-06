@extends('layouts.dashboard')

@section('titol', 'Formulari Activitat')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@push('scripts')
    <script src="{{ asset('js/AdminJS/formActivitat.js') }}"></script>
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 shadow">        
            @if ($accio == 'novaActivitat')
                <h1 class="display-4">Nova activitat</h1><hr><br>
                <form id="formRegistrar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
            
            @elseif ($accio == 'editarActivitat')
                <h1>Editar l'activitat: {{ $activitat->titol }}</h1><hr><br>
                <form id="formActualitzar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
                    <input id="id" name="id" type="hidden" value="{{ $extra->id }}">
            @endif
            
            <div class="form-group row">
                <label for="titol" class="col-md-2 col-form-label text-md-right">{{ __('Titol') }}</label>

                <div class="col-md-8">
                    <input id="titol" type="text" class="form-control @error('titol') is-invalid @enderror" name="titol" value="{{ old('titol', $activitat->titol) }}" pattern="[a-zA-Z\s\.]+" required autocomplete="titol" autofocus>

                    @error('titol')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="descripcio" class="col-md-2 col-form-label text-md-right">{{ __('Descripció') }}</label>

                <div class="col-md-8">
                    <textarea id="descripcio" rows="5" style="width: 450px;" class="form-control @error('descripcio') is-invalid @enderror" name="descripcio" pattern="[a-zA-Z\s]+"  required>{{ old('descripcio', $activitat->descripcio) }}</textarea>

                    @error('descripcio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>    

            <div class="mb-4 mt-4">
                <hr>
                <h3 style="text-align:center;">Tipus de formulari</h3>
                <br>
                <div class="row"> 
                    <!-- TODO PONER COLS PARA TODOS LOS RADIOS -->
                    <!-- TODO HORA INICI Y HORA FI SON LOS CAMPOS QUE FALTAN -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipusFormulari" id="formulariSimple" value="old('tipusFormulari')">
                        <label class="form-check-label" for="formulariSimple">
                            Simple
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipusFormulari" id="formulariCompost" value="old('tipusFormulari')">
                        <label class="form-check-label" for="formulariCompost">
                            Compost
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipusFormulari" id="senseFormulari" value="old('tipusFormulari')" checked>
                        <label class="form-check-label" for="senseFormulari">
                            Sense
                        </label>
                    </div>
                </div>
            </div>
            <hr>

            <div id="formulariTaula" class="form-group mb-4 mt-4">
                <div class="row">
                    <div class="col-6">
                        <h3 style="text-align:center;">Horaris de la activitat</h3>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger" id="afegirCamp" type="button">Afegir camp</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Data Inici</th>
                            <th scope="col">Data fi</th>
                            <th scope="col">Hora Inici</th>
                            <th scope="col">Hora Fi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" name="dataI-opcio" class="form-control"></td>
                            <td><input type="date" name="dataF-opcio" class="form-control"></td>
                            <td><input type="time" name="tipus-opcio" class="form-control"></td>
                            <td><input type="time" name="valor-opcio" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mb-4 mt-4">
                <hr>
                <h3 style="text-align: center;">Extres</h3>
                @foreach($extres as $extra)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="extra-{{ $extra->id }}">
                        <label class="custom-control-label" for="extra-{{ $extra->id }}"><b>{{ $extra->nom }}</b></label>
                    </div>    

                    <div class="form-group row">
                        <label for="extraPreuSoci" class="col-md-3 col-form-label text-md-right">{{ __('Preu soci') }}</label>
        
                        <div class="col-md-8">
                            <input id="extraPreuSoci-{{ $extra->id }}" type="text" class="form-control" value="{{ $extra->preuSoci }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="extraNoPreuSoci" class="col-md-3 col-form-label text-md-right">{{ __('Preu NO soci') }}</label>
        
                        <div class="col-md-8">
                            <input id="extraNoPreuSoci-{{ $extra->id }}" type="text" class="form-control" value="{{ $extra->preuNoSoci }}" readonly>
                        </div>
                    </div>
                    
                @endforeach

            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-2">
                    <button id="submit" type="submit" class="btn btn-lg btn-block btn-danger">
                        @if ($accio == 'editarActivitat')
                            {{ __('Actualitzar') }}
                        @elseif ($accio == 'novaActivitat')
                            {{ __('Afegir') }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection