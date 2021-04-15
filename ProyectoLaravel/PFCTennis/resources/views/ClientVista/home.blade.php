<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Inici</title>
        
        <link rel="stylesheet" href="{{ url('css/home.css') }}" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- <link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css”rel=”nofollow” integrity=”sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm” crossorigin=”anonymous”> -->
         
    <!-- </head> -->
    
    <!-- <body class="antialiased"> -->
@extends('layouts.configuracio')

@section('titol', 'Configuració')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/configuracio.css') }}" >
@endpush
@push('scripts')
    <script src="{{ url('js/ClientJS/configuracio.js') }}">
        window.onload() = function(){init()};
    </script>
@endpush

    <h1>BENVOLGUT A LA TEVA CONFIGURACIÓ: {{ Auth::user()->nom }}</h1>
    
    <form id="formConfiguració">
        @csrf

        <input id="rol" name="rol" type="hidden" value="U">

        <div class="form-group row">
            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

            <div class="col-md-6">
                <input id="nom" type="text" class="form-control @error('name') is-invalid @enderror" name="nom" value="{{ Auth::user()->nom }}" required autocomplete="nom" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="cognoms" class="col-md-4 col-form-label text-md-right">{{ __('Cognoms') }}</label>

            <div class="col-md-6">
                <input id="cognoms" type="text" class="form-control @error('name') is-invalid @enderror" name="cognoms" value="{{ Auth::user()->cognoms }}" required>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="dataNaixement" class="col-md-4 col-form-label text-md-right">{{ __('Data Naixement') }}</label>

            <div class="col-md-6">
                <input id="dataNaixement" type="date" class="form-control @error('name') is-invalid @enderror" name="dataNaixement" value="{{ Auth::user()->dataNaixement }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adreça Email') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="telefon" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

            <div class="col-md-6">
                <input id="telefon" type="text" class="form-control @error('name') is-invalid @enderror" name="telefon" value="{{ Auth::user()->telefon }}" required>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="contrasenya" class="col-md-4 col-form-label text-md-right">{{ __('Contrasenya') }}</label>

            <div class="col-md-6">
                <input id="contrasenya" type="password" class="form-control @error('password') is-invalid @enderror" name="contrasenya" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contrasenya') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="submit" type="submit" class="btn btn-block btn-danger">
                    {{ __('Guardar') }}
                </button>
            </div>
        </div>
    </form>
@endsection