@extends('layouts.dashboard')

@section('title', 'Formulari')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/formVista.css') }}">
    <script src="{{ asset('js/AdminJS/formVista.js') }}"></script>
@endpush
    <!-- TODO CREAR RUTAS PARA DIRIGIR AL FORMULARIO Y CONTROLAR QUE SE MANDE EL TIPO DE OBJETO AL FORMULARIO -->
    <!-- TODO SEGUIR CAMBIANDO LOS SQL POR LOS ::TABLE, AL MENOS LOS SELECTS AGUS... -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formulari: {{ $tipus }}</div>

                <div class="card-body">
                    @if ($accio == 'nouVista')
                        <form id="formRegistrar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
                    @elseif ($accio == 'editarVista')
                        <form id="formActualitzar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
                            <input id="id" name="id" type="hidden" value="{{ $vista->id }}">
                    @endif
                        
                        @csrf
                        
                        <div class="file-upload">
                            <button class="file-upload-btn" onclick="$('.file-upload-input').trigger('click')" type="button">Afegir Imatge</button>

                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text">
                                <h3>Arrosega o selecciona'n una imatge</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="Imatge" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="titol" class="col-md-4 col-form-label text-md-right">{{ __('Titol') }}</label>

                            <div class="col-md-6">
                                <input id="titol" type="text" class="form-control @error('titol') is-invalid @enderror" name="nom" value="{{ $vista->titol }}" pattern="[a-zA-Z\s]+" required autocomplete="titol" autofocus>

                                @error('titol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="descripcio" class="col-md-4 col-form-label text-md-right">{{ __('Descripcio') }}</label>

                            <div class="col-md-6">
                                <textarea id="descripcio" type="text" class="form-control @error('descripcio') is-invalid @enderror" name="nom" value="{{ $vista->descripcio }}" pattern="[a-zA-Z\s]+" required></textarea>

                                @error('descripcio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    @if ($accio == 'editarVista')
                                        {{ __('Actualitzar') }}
                                    @elseif ($accio == 'nouVista')
                                        {{ __('Afegir') }}
                                    @endif
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection