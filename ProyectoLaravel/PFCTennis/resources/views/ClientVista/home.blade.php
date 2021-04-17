@extends('layouts.configuracio')

@section('titol', 'Configuració')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/configuracio.css') }}" >

@push('scripts')
    <script src="{{ url('js/ClientJS/configuracio.js') }}"></script>
@endpush
    <script>
        var emailActual = "{{ Auth::user()->email }}";
    </script>

    <h1>BENVOLGUT A LA TEVA CONFIGURACIÓ: {{ Auth::user()->nom }}</h1>
    <form id="formConfiguració" action="/configuracio/cambiardades" onsubmit="return comprovarFormulari()" method="POST">
        @csrf

        <input id="id" name="id" type="hidden" value="{{ Auth::user()->id }}">
        <input id="rol" name="rol" type="hidden" value="{{ Auth::user()->rol }}">

        <div class="form-group row">
            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

            <div class="col-md-6">
                <input id="nom" type="text" class="form-control @error('name') is-invalid @enderror" name="nom" value="{{ Auth::user()->nom }}" pattern="[a-zA-Z]+" required autocomplete="nom" autofocus>

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
                <input id="cognoms" type="text" class="form-control @error('name') is-invalid @enderror" name="cognoms" value="{{ Auth::user()->cognoms }}" pattern="[a-zA-Z\s]+" required>

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
                <input id="telefon" type="text" class="form-control @error('name') is-invalid @enderror" name="telefon" pattern="[0-9]{9}" value="{{ Auth::user()->telefon }}" required>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- <div class="form-group row">
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
        </div> -->

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="submit" type="submit" class="btn btn-block btn-danger">
                    {{ __('Guardar') }}
                </button>
            </div>
        </div>
    </form>

@endsection