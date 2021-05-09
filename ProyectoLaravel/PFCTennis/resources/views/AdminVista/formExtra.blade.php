@extends('layouts.dashboard')

@section('titol', 'Formulari Activitat')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 shadow-lg">

        @if ($accio == 'nouExtra')
            <h1 class="display-4">Crear extra</h1><hr><br>
            <form id="formRegistrar" method="POST" action="{{ route('activitats.extres.afegir') }}" onsubmit="return comprovarFormulariGeneral()">
        
        @elseif ($accio == 'editarExtra')
            <h1>Editar l'extra: {{ $extra->nom }}</h1><hr><br>
            <form id="formActualitzar" method="POST" action="{{ route('activitats.extres.modificar') }}" onsubmit="return comprovarFormulariGeneral()">
                <input id="id" name="id" type="hidden" value="{{ $extra->id }}">
        @endif

            @csrf

            <div class="form-group row">
                <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom d\'extra') }}</label>

                <div class="col-md-6">
                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $extra->nom) }}" pattern="[a-zA-Z\s\.]+" required autocomplete="nom" autofocus>

                    @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="preuSoci" class="col-md-4 col-form-label text-md-right">{{ __('Preu per socis') }}</label>

                <div class="col-md-6">
                    <input id="preuSoci" type="number" step="0.01" class="form-control @error('preuSoci') is-invalid @enderror" name="preuSoci" value="{{ old('preuSoci', $extra->preuSoci) }}" required>

                    @error('preuSoci')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="preuNoSoci" class="col-md-4 col-form-label text-md-right">{{ __('Preu per socis') }}</label>

                <div class="col-md-6">
                    <input id="preuNoSoci" type="number" step="0.01" class="form-control @error('preuNoSoci') is-invalid @enderror" name="preuNoSoci" value="{{ old('preuNoSoci', $extra->preuNoSoci) }}" required>

                    @error('preuNoSoci')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="submit" type="submit" class="btn btn-danger btn-lg btn-block">
                        @if ($accio == 'editarExtra')
                            {{ __('Actualitzar') }}
                        @elseif ($accio == 'nouExtra')
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