@extends('layouts.configuracio')

@section('titol', 'Cambiar Contrasenya')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/configuracio.css') }}" >

@push('scripts')
    <script src="{{ url('js/ClientJS/cambiarpassword.js') }}"></script>
@endpush

    <h1>CAMBIAR LA CONTRASENYA DE: {{ Auth::user()->nom }}</h1>
    <form id="formConfiguració" action="/configuracio/cambiarpassword" onsubmit="return comprovarFormulari()" method="POST">
        @csrf

        <input id="id" name="id" type="hidden" value="{{ Auth::user()->id }}">
        <input id="rol" name="rol" type="hidden" value="{{ Auth::user()->rol }}">

        <div class="form-group row">
            <label for="contrasenya" class="col-md-4 col-form-label text-md-right">{{ __('Contrasenya') }}</label>

            <div class="col-md-6">
                <input id="contrasenya" type="password" class="form-control @error('contrasenya') is-invalid @enderror" name="contrasenya" required autocomplete="new-password">

                @error('contrasenya')
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
                    {{ __('Cambiar Contrasenya') }}
                </button>
            </div>
        </div>
    </form>

@endsection