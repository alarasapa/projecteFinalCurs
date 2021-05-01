@extends('layouts.configuracio')

@section('titol', 'Cambiar Localització')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/configuracio.css') }}" >
@endpush

    <h1>CAMBIAR LA LOCALITZACIÓ DE: {{ Auth::user()->nom }}</h1>
    <form id="formConfiguració" action="{{ route('cambiarLocalitzacio') }}" method="POST">
        @csrf

        <input id="id" name="id" type="hidden" value="{{ $localitzacio->id }}">

        <div class="form-group row">
            <label for="adreca" class="col-md-4 col-form-label text-md-right">{{ __('Adreça') }}</label>

            <div class="col-md-6">
                <input id="adreca" type="text" class="form-control @error('adreca') is-invalid @enderror" name="adreca" value="{{ old('adreca', $localitzacio->adreca) }}" pattern="[a-zA-Z\s\\]+" required>

                @error('adreca')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row">
            <label for="poblacio" class="col-md-4 col-form-label text-md-right">{{ __('Població') }}</label>

            <div class="col-md-6">
                <input id="poblacio" type="text" class="form-control @error('poblacio') is-invalid @enderror" name="poblacio" value="{{ old('poblacio', $localitzacio->poblacio) }}" pattern="[a-zA-Z\s]+" required>

                @error('poblacio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="codiPostal" class="col-md-4 col-form-label text-md-right">{{ __('Codi Postal') }}</label>

            <div class="col-md-6">
                <input id="codiPostal" type="text" class="form-control @error('codiPostal') is-invalid @enderror" name="codiPostal" value="{{ old('codiPostal', $localitzacio->codiPostal) }}" pattern="[0-9]{5}" required>

                @error('codiPostal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

            <div class="col-md-6">
                <input id="provincia" type="text" class="form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia', $localitzacio->provincia) }}" pattern="[a-zA-Z\s]+" required>

                @error('provincia')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="submit" type="submit" class="btn btn-block btn-danger">
                    {{ __('Cambiar Dades') }}
                </button>
            </div>
        </div>

    </form>

@endsection