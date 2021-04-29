@extends('layouts.configuracio')

@section('titol', 'Configuració')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/configuracio.css') }}" >

@push('scripts')
    <script src="{{ url('js/ClientJS/configuracio.js') }}"></script>
@endpush
    <script>
        var nifActual = "{{ Auth::user()->nif }}";
        var emailActual = "{{ Auth::user()->email }}";
        var targetaSantaria = "{{ Auth::user()->targetaSanitaria }}";
    </script>

    <h1>BENVOLGUT A LA TEVA CONFIGURACIÓ: {{ Auth::user()->nom }}</h1>
    <form id="formConfiguració" action="{{ route('cambiarDades') }}" onsubmit="return comprovarFormulari()" method="POST">
        @csrf

        <input id="id" name="id" type="hidden" value="{{ Auth::user()->id }}">
        <input id="rol" name="rol" type="hidden" value="{{ Auth::user()->rol }}">

        <div class="form-group row">
            <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('DNI/NIF') }}</label>

            <div class="col-md-6">
                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif', Auth::user()->nif) }}" pattern="[0-9]{8}[a-zA-Z]" required>
            </div>

            @error('nif')
                <span class="text-danger" style="position: relative; left: 250px">
                    <smmall><strong>{{ $message }}</strong></small>
                </span>
            @enderror
        </div>

        <div class="form-group row">
            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

            <div class="col-md-6">
                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', Auth::user()->nom) }}" pattern="[a-zA-Z\s]+" required autocomplete="nom" autofocus>

                @error('nom')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="cognoms" class="col-md-4 col-form-label text-md-right">{{ __('Cognoms') }}</label>

            <div class="col-md-6">
                <input id="cognoms" type="text" class="form-control @error('cognoms') is-invalid @enderror" name="cognoms" value="{{ old('cognoms', Auth::user()->cognoms) }}" pattern="[a-zA-Z\s]+" required>

                @error('cognoms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="dataNaixement" class="col-md-4 col-form-label text-md-right">{{ __('Data Naixement') }}</label>

            <div class="col-md-6">
                <input id="dataNaixement" type="date" class="form-control @error('dataNaixement') is-invalid @enderror" name="dataNaixement" value="{{ old('dataNaixement', Auth::user()->dataNaixement) }}" required>

                @error('dataNaixement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adreça Email') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="targetaSanitaria" class="col-md-4 col-form-label text-md-right">{{ __('Targeta sanitària') }}</label>

            <div class="col-md-6">
                <input id="targetaSanitaria" type="text" class="form-control @error('targetaSanitaria') is-invalid @enderror" name="targetaSanitaria" value="{{ old('targetaSanitaria', Auth::user()->targetaSanitaria) }}" pattern="[a-zA-Z]{4}[0-9]{10}" required>
            </div>

            @error('targetaSanitaria')
                <span class="text-danger" style="position: relative; left: 250px">
                    <smmall><strong>{{ $message }}</strong></small>
                </span>
            @enderror
        </div>

        <div class="form-group row">
            <label for="telefon" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

            <div class="col-md-6">
                <input id="telefon" type="text" class="form-control @error('telefon') is-invalid @enderror" name="telefon" pattern="[0-9]{9}" value="{{ old('telefon', Auth::user()->telefon) }}" required>

                @error('telefon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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