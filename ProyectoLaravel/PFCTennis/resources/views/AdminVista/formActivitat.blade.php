@extends('layouts.dashboard')

@section('titol', 'Formulari Activitat')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('js/AdminJS/formActivitat.js') }}"></script>
@endpush

@section('content')
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 shadow-lg">        
            @if ($accio == 'novaActivitat')
                <h1 class="display-4">Nova activitat</h1><hr><br>
                <form id="formRegistrar" method="POST" action="{{ route('activitats.activitat.afegir') }}" onsubmit="return comprovarFormulariGeneral()">
            
            @elseif ($accio == 'editarActivitat')
                <h1>Editar l'activitat: {{ $activitat->titol }}</h1><hr><br>
                <form id="formActualitzar" method="POST" action="{{ route('activitats.activitat.modificar') }}" onsubmit="return comprovarFormulariGeneral()">
                    <input id="id" name="id" type="hidden" value="{{ $activitat->id }}">
            @endif
            
            @csrf

            <div class="row offset-md-1 mb-4">
                    <div class="d-flex col-md-9 justify-content-between">
                        <label>Selecciona un tipus d'activitat</label>
                        <div class="form-group">
                            <select name="idTipusActivitat" class="selectpicker" data-live-search="true">
                                @foreach ($tipusActivitats as $tipusAct)
                                    @if ($accio == 'editarActivitat')
                                        <option value="{{ $tipusAct->id }}" data-tokens="{{ $tipusAct->nom }}" {{ ($tipusAct->id == $activitat->idTipusActivitat) ? 'selected' : '' }}>{{ $tipusAct->nom }}</option>
                                    @else
                                        <option value="{{ $tipusAct->id }}" data-tokens="{{ $tipusAct->nom }}">{{ $tipusAct->nom }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

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
                <h3 style="text-align:center;">Formulari</h3>
                <br>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="formulari" value="old('formulari')" class="custom-control-input" id="switchFormulari" {{ ($activitat->formulari) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="switchFormulari">Tindrà formulari?</label>
                </div>
            </div>
            <hr>

            <div class="row mb-4 mt-4">
                <div class="col-md-11 offset-md-3">
                    <label>Selecciona els extres que tindrá l'activitat</label>
                </div>
                <div class="col-md-9 offset-md-4">
                    <div class="form-outline">
                        <select name="extraOpcions[]" class="selectpicker" data-live-search="true" multiple data-mdb-clear-button="true">
                            @foreach ($extres as $extra)
                                @if ($accio == 'editarActivitat')
                                    <option value="{{ $extra->id }}" data-tokens="{{ $extra->nom }}" {{ ($extra->idActivitat == $activitat->id) ? 'selected' : '' }}>
                                        {{ $extra->nom }}
                                    </option>
                                @else
                                    <option value="{{ $extra->id }}" data-tokens="{{ $extra->nom }}">
                                        {{ $extra->nom }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- <div id="formulariTaula" class="form-group mb-4 mt-4">
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
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" name="dataInici[]" class="form-control"></td>
                            <td><input type="date" name="dataFi[]" class="form-control"></td>
                            <td><input type="time" name="horaInici[]" class="form-control"></td>
                            <td><input type="time" name="horaFi[]" class="form-control"></td>
                            <td><button type="button" onclick="$(this).closest('tr').remove()"><i class="fa fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div> -->

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