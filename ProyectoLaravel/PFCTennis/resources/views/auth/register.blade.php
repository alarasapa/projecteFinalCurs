<!DOCTYPE html>
<html>
<head>
    <title>Registrar-se</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
            <a class="navbar-brand" href="{{ url('/') }}">Tornar</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrar-se al Club de Tennis') }}</div>

                    <div class="card-body">

                        <form id="form" method="POST" action="{{ url('/registrarse') }}" onsubmit="return comprovarFormulari()">
                            @csrf

                            <input id="rol" name="rol" type="hidden" value="U">

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('name') is-invalid @enderror" name="nom" value="{{ old('nom') }}" pattern="[a-zA-Z]+" required autocomplete="nom" autofocus>

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
                                    <input id="cognoms" type="text" class="form-control @error('name') is-invalid @enderror" name="cognoms" value="{{ old('cognoms') }}" pattern="[a-zA-Z\s]+" required>

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
                                    <input id="nif" type="text" class="form-control @error('name') is-invalid @enderror" name="nif" value="{{ old('nif') }}" >
                                </div>

                                @error('nif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="dataNaixement" class="col-md-4 col-form-label text-md-right">{{ __('Data Naixement') }}</label>

                                <div class="col-md-6">
                                    <input id="dataNaixement" type="date" class="form-control @error('name') is-invalid @enderror" name="dataNaixement" value="{{ old('dataNaixement') }}">

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
                                    <input id="targetaSanitaria" type="text" class="form-control @error('name') is-invalid @enderror" name="targetaSanitaria" value="{{ old('targetaSanitaria') }}" pattern="[a-zA-Z]{4}[0-9]{10}" required>
                                </div>

                                @error('targetaSanitaria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="telefon" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                                <div class="col-md-6">
                                    <input id="telefon" type="text" class="form-control @error('name') is-invalid @enderror" name="telefon" value="{{ old('telefon') }}" pattern="[0-9]{9}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>