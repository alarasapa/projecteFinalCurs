@extends('layouts.dashboard')

@section('titol', 'Formulari d\'Usuari')

@push('css')
    <link rel="stylesheet" href="../../../../../css/AdminEstils/index.css">
@endpush

@section('content')

<script>
    window.onload = function(){
        $("#telefon").change(function() {
            let telefon = $("#telefon").val();
            if (isNaN(telefon)) {
                alert("El numero de telefon ha de tenir només numeros");
            } else if (telefon.length < 9) {
                alert("El numero de telfon no té la quantitat de numeros adequada");
            }
        });
    
        $("#email").on("change", function() {
            comprovarEmail();
        });
    
        $("#contrasenya").change(function() {
            let password = $("#contrasenya").val();
    
            if (password.length < 8) {
                alert("La contrasenya ha de tenir 8 caracters com a mínim");
            } else if (!isNaN(password) || /^[a-zA-Z]+$/.test(password)) {
                alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
            }
        });
    
        $("#password-confirm").on("change", function() {
            let password = $("#contrasenya").val();
            let passwordConf = $("#password-confirm").val();
    
            if (password != passwordConf) {
                alert("La contrasenya de confirmació no és la mateixa a la introduïda");
            }
        });
    }

    function comprovarEmail() {
        let tipusDada = $("#email").val();

        let json = JSON.stringify({ valor: tipusDada, '_token': $('input[name=_token]').val() });

        $.ajax({
            type: 'POST',
            url: '/registrarse/comprovar',
            data: json,
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'content-type': 'application/json'
            },
            success: function(res) {
                if (res == 1) {
                    alert("Aquest email ja está en ús");
                    emailValido = false;
                } else {
                    emailValido = true;
                }
            }
        })
    }

    function comprovarFormulariGeneral() {
        let estat = true;

        if (!emailValido) {
            alert("Aquest email ja está en ús");
            estat = false;
        }

        return estat;
    }

    function comprovarContrasenya(){
        let estat = true;

        if ($("#contrasenya").val().length < 8) {
            alert("La contrasenya ha de tenir 8 caracters com a mínim");
            estat = false;
        } else if (!isNaN($("#contrasenya").val()) || /^[a-zA-Z]+$/.test($("#contrasenya").val())) {
            alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
            estat = false;
        } else if ($("#contrasenya").val() != $("#password-confirm").val()) {
            alert("La contrasenya de confirmació no és la mateixa a la introduïda");
            estat = false;
        }

        return estat;
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($accio == 'editarUsuari')
                    <div class="card-header">Formulari Usuari: {{ $usuari->nom }}</div>
                @else
                    <div class="card-header">{{ __('Formulari Usuari') }}</div>
                @endif

                <div class="card-body">
                    @if ($accio == 'nouUsuari')
                        <form id="formRegistrar" method="POST" action="/dashboard/gestio/usuaris/registrarse" onsubmit="return comprovarFormulariGeneral()">
                    @elseif ($accio == 'editarUsuari')
                        <form id="formActualitzar" method="POST" action="/dashboard/gestio/usuaris/actualizar" onsubmit="return comprovarFormulariGeneral()">
                            <input id="id" name="id" type="hidden" value="{{ $usuari->id }}">
                    @endif

                        @csrf

                        <select name="rol" id="rol">
                            <option value="U" @if($usuari->rol == 'U') selected = "selected" @endif>Usuari</option>
                            <option value="S" @if($usuari->rol == 'S') selected = "selected" @endif>Soci</option>
                            <option value="A" @if($usuari->rol == 'A') selected = "selected" @endif>Administrador</option>
                        </select>

                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control @error('name') is-invalid @enderror" name="nom" value="{{ $usuari->nom }}" pattern="[a-zA-Z\s]+" required autocomplete="nom" autofocus>

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
                                <input id="cognoms" type="text" class="form-control @error('name') is-invalid @enderror" name="cognoms" value="{{ $usuari->cognoms }}" pattern="[a-zA-Z\s]+" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('DNI/NIF') }}</label>

                            <div class="col-md-6">
                                <input id="nif" type="text" class="form-control @error('name') is-invalid @enderror" name="nif" value="{{ $usuari->nif }}" pattern="[0-9]{8}[a-zA-Z]" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dataNaixement" class="col-md-4 col-form-label text-md-right">{{ __('Data Naixement') }}</label>

                            <div class="col-md-6">
                                <input id="dataNaixement" type="date" class="form-control @error('name') is-invalid @enderror" name="dataNaixement" value="{{ $usuari->dataNaixement }}">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuari->email }}" required autocomplete="email">

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
                                <input id="targetaSanitaria" type="text" class="form-control @error('name') is-invalid @enderror" name="targetaSanitaria" value="{{ $usuari->targetaSanitaria }}" pattern="[a-zA-Z]{4}[0-9]{10}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefon" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                            <div class="col-md-6">
                                <input id="telefon" type="text" class="form-control @error('name') is-invalid @enderror" name="telefon" value="{{ $usuari->telefon }}" pattern="[0-9]{9}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    {{ __('Actualitzar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-header">Cambiar contrasenya</div>
                    <form id="formContrasenya" method="POST" action="/dashboard/gestio/usuaris/actualizar" onsubmit="return comprovarContrasenya()">
                        @csrf

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
                                <button id="submit" type="submit" class="btn btn-primary">
                                    {{ __('Cambiar Contrasenya') }}
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