@extends('layouts.dashboard')

@section('titol', 'Formulari d\'Usuari')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@push('scripts')
    <script src="{{ asset('js/AdminJS/formUsuari.js') }}"></script>
@endpush

@section('content')

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
                        <form id="formRegistrar" method="POST" action="{{ route('registrarAdmin') }}" onsubmit="return comprovarFormulariGeneral()">
                    @elseif ($accio == 'editarUsuari')
                        <form id="formActualitzar" method="POST" action="{{ route('actualitzarUsuari') }}" onsubmit="return comprovarFormulariGeneral()">
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
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $usuari->nom) }}" pattern="[a-zA-Z\s]+" required autocomplete="nom" autofocus>

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
                                <input id="cognoms" type="text" class="form-control @error('cognoms') is-invalid @enderror" name="cognoms" value="{{ old('cognoms', $usuari->cognoms) }}" pattern="[a-zA-Z\s]+" required>

                                @error('congoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('DNI/NIF') }}</label>

                            <div class="col-md-6">
                                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif', $usuari->nif) }}" pattern="[0-9]{8}[a-zA-Z]" required>
                            </div>
                            @error('nif')
                                <span class="text-danger" style="position: relative; left: 250px">
                                    <smmall><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="dataNaixement" class="col-md-4 col-form-label text-md-right">{{ __('Data Naixement') }}</label>

                            <div class="col-md-6">
                                <input id="dataNaixement" type="date" class="form-control @error('dataNaixement') is-invalid @enderror" name="dataNaixement" value="{{ old('dataNaixemnt', $usuari->dataNaixement) }}" required>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $usuari->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="card">
                                <div class="card-header">La teva Localitzacio</div>
                                <div class="card-body">
                                @if ($accio == 'editarUsuari')
                                    <input id="idLocalitzacio" name="idLocalitzacio" type="hidden" value="{{ $usuari->localitzacio->id }}">
                                @endif
                                    <div class="form-group row">
                                        <label for="adreca" class="col-md-4 col-form-label text-md-right">{{ __('Adreça') }}</label>

                                        <div class="col-md-6">
                                            <input id="adreca" type="text" class="form-control @error('adreca') is-invalid @enderror" name="adreca" value="{{ old('adreca', $usuari->localitzacio->adreca) }}" pattern="[a-zA-Z\s\\]+" required>

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
                                            <input id="poblacio" type="text" class="form-control @error('poblacio') is-invalid @enderror" name="poblacio" value="{{ old('poblacio', $usuari->localitzacio->poblacio) }}" pattern="[a-zA-Z\s]+" required>

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
                                            <input id="codiPostal" type="text" class="form-control @error('codiPostal') is-invalid @enderror" name="codiPostal" value="{{ old('codiPostal', $usuari->localitzacio->codiPostal) }}" pattern="[0-9]{5}" required>

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
                                            <input id="provincia" type="text" class="form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia', $usuari->localitzacio->provincia) }}" pattern="[a-zA-Z\s]+" required>

                                            @error('provincia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="targetaSanitaria" class="col-md-4 col-form-label text-md-right">{{ __('Targeta sanitària') }}</label>

                            <div class="col-md-6">
                                <input id="targetaSanitaria" type="text" class="form-control @error('targetaSanitaria') is-invalid @enderror" name="targetaSanitaria" value="{{ old('targetaSanitaria', $usuari->targetaSanitaria) }}" pattern="[a-zA-Z]{4}[0-9]{10}" required>
                            </div>

                            @error('targetaSanitaria')
                                <span class="text-danger" style="position: relative; left: 250px">
                                    <small><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="telefon" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                            <div class="col-md-6">
                                <input id="telefon" type="text" class="form-control @error('telefon') is-invalid @enderror" name="telefon" value="{{ old('telefon', $usuari->telefon) }}" pattern="[0-9]{9}" required>
                            
                                @error('telefon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefon2" class="col-md-4 col-form-label text-md-right">{{ __('Segon Telefon') }}</label>

                            <div class="col-md-6">
                                <input id="telefon2" type="text" class="form-control @error('telefon2') is-invalid @enderror" name="telefon2" value="{{ old('telefon2', $usuari->telefon2) }}" pattern="[0-9]{9}">
                            
                                @error('telefon2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if ($accio == 'nouUsuari')
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
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    @if ($accio == 'editarUsuari')
                                        {{ __('Actualitzar') }}
                                    @elseif ($accio == 'nouUsuari')
                                        {{ __('Registrar') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($accio == 'editarUsuari')
                <div class="card">
                    <div class="card-header">Cambiar contrasenya</div>
                    <form id="formContrasenya" method="POST" action="{{ route('cambiarPassword') }}" onsubmit="return comprovarContrasenya()">
                        @csrf

                        <input id="id" name="id" type="hidden" value="{{ $usuari->id }}">

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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection