<!DOCTYPE html>
<html>
<head>
    <title>Registrar-se</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ClientEstils/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iniciSessio.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <script src="js/ClientJS/registrarse.js"></script>
</head>

<body onload="init()">
    
    @if (Auth::check())
    <script>
        location.href = '/home';
    </script>
    @endif

    <div class="container">
        <div class="row">
            <a class="navbar-brand mt-4" href="{{ url('/') }}">Tornar</a>
        </div>

        <h1 style="text-decoration: underline;" class="mb-2">{{ __('Registrar-se al Club de Tennis') }}</h1>

        @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <form id="form" method="POST" action="{{ url('/registrarse') }}" onsubmit="return comprovarFormulari()">
                    @csrf
                        <h3 class="mb-2">{{ __('Informació general') }}</h3>

                        <input id="rol" name="rol" type="hidden" value="U">

                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" pattern="[a-zA-Z]+" required autocomplete="nom" autofocus>

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
                                <input id="cognoms" type="text" class="form-control @error('cognoms') is-invalid @enderror" name="cognoms" value="{{ old('cognoms') }}" pattern="[a-zA-Z\s]+" required>

                                @error('cognoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('DNI/NIF') }}</label>

                            <div class="col-md-6">
                                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif') }}" >
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
                                <input id="dataNaixement" type="date" class="form-control @error('dataNaixement') is-invalid @enderror" name="dataNaixement" value="{{ old('dataNaixement') }}" required>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="targetaSanitaria" type="text" class="form-control @error('targetaSanitaria') is-invalid @enderror" name="targetaSanitaria" value="{{ old('targetaSanitaria') }}" pattern="[a-zA-Z]{4}[0-9]{10}" required>
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
                                <input id="telefon" type="text" class="form-control @error('telefon') is-invalid @enderror" name="telefon" value="{{ old('telefon') }}" pattern="[0-9]{9}" required>

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
                                <input id="telefon2" type="text" class="form-control @error('telefon2') is-invalid @enderror" name="telefon2" value="{{ old('telefon2') }}" pattern="[0-9]{9}">

                                @error('telfon2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                </div>
                        <div class="col-md-6">
                            <h3 class="mb-3">La teva Localitzacio</h3>
                            <div class="form-group row">
                                <label for="adreca" class="col-md-4 col-form-label text-md-right">{{ __('Adreça') }}</label>

                                <div class="col-md-6">
                                    <input id="adreca" type="text" class="form-control @error('adreca') is-invalid @enderror" name="adreca" value="{{ old('adreca') }}" pattern="[a-zA-Z\s\\]+" required>

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
                                    <input id="poblacio" type="text" class="form-control @error('poblacio') is-invalid @enderror" name="poblacio" value="{{ old('poblacio') }}" pattern="[a-zA-Z\s]+" required>

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
                                    <input id="codiPostal" type="text" class="form-control @error('codiPostal') is-invalid @enderror" name="codiPostal" value="{{ old('codiPostal') }}" pattern="[0-9]{5}" required>

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
                                    <input id="provincia" type="text" class="form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia') }}" pattern="[a-zA-Z\s]+" required>

                                    @error('provincia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <h3 class="mb-3 mt-3">Contrasenya</h3>

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
                                <button id="submit" type="submit" class="btn btn-danger btn-lg btn-block">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>