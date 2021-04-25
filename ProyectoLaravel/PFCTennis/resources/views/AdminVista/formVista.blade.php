@extends('layouts.dashboard')

@section('title', 'Formulari')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/formVista.css') }}">
    <script src="{{ asset('js/AdminJS/formVista.js') }}"></script>
@endpush

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
                        
                        <div class="img-actual">
                            <h3>Imatge actual</h3>
                            <img width="400" src="{{ asset('imatges/'. $tipus .'/' . $vista->imatge) }}">
                        </div>

                        <div class="file-upload">
                            <button class="file-upload-btn" onclick="$('.file-upload-input').trigger('click')" type="button">Afegir Imatge</button>

                            <div class="image-upload-wrap">
                                <input class="file-upload-input" name="imatge" type='file' onchange="readURL(this);" accept="image/*" />
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
                            <label for="descripcio" class="col-md-4 col-form-label text-md-right">{{ __('Descripció') }}</label>

                            <div class="col-md-6">
                                <textarea id="descripcio" rows="5" style="width: 450px;" class="form-control @error('descripcio') is-invalid @enderror" name="nom" pattern="[a-zA-Z\s]+"  required>{{ $vista->descripcio }}</textarea>

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