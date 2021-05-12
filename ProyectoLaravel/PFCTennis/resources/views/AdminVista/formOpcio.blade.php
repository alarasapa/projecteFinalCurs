@extends('layouts.dashboard')

@section('titol', 'Formulari opció')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 mt-4 shadow-lg">

        @if ($accio == 'novaOpcio')
            <h1 class="display-4">Crear opció {{ $tipus }}</h1><hr><br>
            <form id="formRegistrar" method="POST" action="{{ route('activitats.opcions.afegir', ['tipus' => $tipus]) }}" onsubmit="return comprovarFormulariGeneral()">

        @elseif ($accio == 'editarOpcio')
            <h1>Editar opció: {{ $opcio->nom }}</h1><hr><br>
            <form id="formActualitzar" method="POST" action="{{ route('activitats.opcions.modificar', ['tipus' => $tipus]) }}" onsubmit="return comprovarFormulariGeneral()">
                <input id="id" name="id" type="hidden" value="{{ $opcio->id }}">
        @endif

            @csrf

            <input name="idGrupOpcio" type="hidden" value="{{ $grupOpcio->id }}">

            <div class="form-group row">
                <label for="nom" class="col-md-3 col-form-label text-md-right">{{ __('Nom de la opció') }}</label>

                <div class="col-md-6">
                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $opcio->nom) }}" required autocomplete="nom" autofocus>

                    @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            @if ($tipus == 'general' || $tipus == 'generals')
                <div class="form-group row">
                    <label for="preuSoci" class="col-md-3 col-form-label text-md-right">{{ __('Preu per socis') }}</label>

                    <div class="col-md-6">
                        <input id="preuSoci" type="number" step="0.01" class="form-control @error('preuSoci') is-invalid @enderror" name="preuSoci" value="{{ old('preuSoci', $opcio->preuSoci) }}" required>

                        @error('preuSoci')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row {{ ($grupOpcio->sociOnly) ? 'd-none' : '' }}">
                    <label for="preu" class="col-md-3 col-form-label text-md-right">{{ __('Preu per NO socis') }}</label>

                    <div class="col-md-6">
                        <input id="preu" type="number" step="0.01" class="form-control @error('preu') is-invalid @enderror" name="preu" value="{{ old('preu', $opcio->preu) }}" {{ ($grupOpcio->sociOnly) ? '' : 'required'}}>

                        @error('preu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row px-2"> 
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipus" id="formulariSimple" value="inmediat" checked>
                            <label class="form-check-label" for="formulariSimple">
                                Inmediat
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipus" id="formulariCompost" value="mensual" {{ ($opcio->tipus == 'mensual') ? 'checked' : '' }}>
                            <label class="form-check-label" for="formulariCompost">
                                Mensual
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipus" id="senseFormulari" value="persona" {{ ($opcio->tipus == 'persona') ? 'checked' : '' }}>
                            <label class="form-check-label" for="senseFormulari">
                                Persona
                            </label>
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group row mt-4">
                <div class="col-md-6 offset-md-2">
                    <button id="submit" type="submit" class="btn btn-danger btn-lg btn-block">
                        @if ($accio == 'editarOpcio')
                            {{ __('Actualitzar') }}
                        @elseif ($accio == 'novaOpcio')
                            {{ __('Afegir') }}
                        @endif
                    </button>
                </div>
            </div>

            </form>
        </div>  
    </div>
</div>

@endsection