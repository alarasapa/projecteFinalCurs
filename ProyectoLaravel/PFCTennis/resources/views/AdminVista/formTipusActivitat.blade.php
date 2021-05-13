@extends('layouts.dashboard')

@section('titol', 'Formulari tipus activitat')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 mt-4 shadow-lg">

        @if ($accio == 'nouTipusActivitat')
            <h1 class="display-4">Crear tipus activitat</h1><hr><br>
            <form id="formRegistrar" method="POST" action="{{ route('activitats.tipusActivitats.afegir') }}" onsubmit="return comprovarFormulariGeneral()">

        @elseif ($accio == 'editarTipusActivitat')
            <h1>Editar tipus: {{ $tipusActivitat->nom }}</h1><hr><br>
            <form id="formActualitzar" method="POST" action="{{ route('activitats.tipusActivitats.modificar') }}" onsubmit="return comprovarFormulariGeneral()">
                <input id="id" name="id" type="hidden" value="{{ $tipusActivitat->id }}">
        @endif

            @csrf

            <div class="form-group row">
                <label for="nom" class="col-md-3 col-form-label text-md-right">{{ __('Nom de categoria') }}</label>

                <div class="col-md-6">
                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $tipusActivitat->nom) }}" required autocomplete="nom" autofocus>

                    @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-4">
                <div class="col-md-6 offset-md-2">
                    <button id="submit" type="submit" class="btn btn-danger btn-lg btn-block">
                        @if ($accio == 'editarTipusActivitat')
                            {{ __('Actualitzar') }}
                        @elseif ($accio == 'nouTipusActivitat')
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