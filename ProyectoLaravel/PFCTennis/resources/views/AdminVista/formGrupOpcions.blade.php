@extends('layouts.dashboard')

@section('titol', 'Formulari Grup opció ' . $tipus)

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 shadow-lg mt-3">

        @if ($accio == 'nouGrupOpcio')
            <h1 class="display-4">Crear Grup opcions {{ $tipus }}</h1><hr><br>
            <form id="formRegistrar" method="POST" action="{{ route('activitats.grupopcions.afegir', ['tipus' => $tipus]) }}" onsubmit="return comprovarFormulariGeneral()">

        @elseif ($accio == 'editarGrup')
            <h1>Editar Grup opcions general: {{ $grup->nom }}</h1><hr><br>
            <form id="formActualitzar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
                <input id="id" name="id" type="hidden" value="{{ $grup->id }}">
        @endif

                @csrf

                <div class="row mb-4">
                    <div class="col-md-11 offset-md-2">
                        <label>Selecciona una activitat, on s'utilitzarà aquest grup d'opcions</label>
                    </div>
                    <div class="col-md-10 offset-md-4">
                        <div class="form-group">
                            <select name="activitatOpcio" class="selectpicker" data-live-search="true">
                                @foreach ($activitats as $act)
                                    @if ($act->formulari)
                                        <option value="{{ $act->id }}" data-tokens="{{ $act->titol }}">{{ $act->titol }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nom" class="col-md-3 col-form-label text-md-right">{{ __('Títol del grup') }}</label>

                    <div class="col-md-6">
                        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $grup->nom) }}" pattern="[a-zA-Z\s\.]+" required autocomplete="nom" autofocus>

                        @error('nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcio" class="col-md-3 col-form-label text-md-right">{{ __('Descripció del grup') }}</label>

                    <div class="col-md-6">
                        <textarea id="descripcio" class="form-control @error('descripcio') is-invalid @enderror" name="descripcio" required>{{ old('descripcio', $grup->descripcio) }}</textarea>

                        @error('descripcio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-6 offset-md-1 mt-4">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" value="simple" name="tipus" autocomplete="off" {{ ($grup->tipus == 'simple') ? 'checked' : '' }} required> Opcions Simples
                            </label>

                            <label class="btn btn-secondary">
                                <input type="radio" value="complex" name="tipus" autocomplete="off" {{ ($grup->tipus == 'complex') ? 'checked' : '' }} required> Opcions Complexes
                            </label>

                            @error('tipusOpcio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="custom-control custom-switch py-2">
                            <input type="checkbox" name="sociOnly" class="custom-control-input" id="switchFormulari" {{ ($grup->sociOnly) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="switchFormulari">Només per socis</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0 mt-4">
                    <div class="col-md-6 offset-md-3">
                        <button id="submit" type="submit" class="btn btn-lg btn-block btn-danger">
                            @if ($accio == 'editarGrupOpcio')
                                {{ __('Actualitzar') }}
                            @elseif ($accio == 'nouGrupOpcio')
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