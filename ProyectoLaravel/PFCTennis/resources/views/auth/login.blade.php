<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sessió</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ClientEstils/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iniciSessio.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>

<body>
    <div class="container">
        <div class="row">
            <a class="navbar-brand mt-4" href="{{ url('/') }}">Tornar</a>
        </div>
        
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1 class="mb-4">{{ __('Iniciar Sessió al club') }}</h1>

                @if (session('status'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times</span>
                        </button>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="usuariEmail" class="col-md-4 col-form-label text-md-right">{{ __('Adreça Email') }}</label>

                        <div class="col-md-6">
                            <input id="usuariEmail" class="form-control @error('usuariEmail') is-invalid @enderror" type="email" name="usuariEmail" value="{{ old('usuariEmail') }}" required autofocus>
                            
                            @error('usuariEmail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __('Aquest email o la contrasenya no és correcte o no existeix') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contrasenya') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __('Aquest email o la contrasenya no és correcte o no existeix') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Enrecorda\'m') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="btn btn-danger btn-lg btn-block">
                                {{ __('Entrar') }}
                            </button>
                            <!-- CAMBIAR LA RUTA DE CAMBIAR PASSWORD -->
                            @if (Route::has('password.request'))
                                <a style="color: white !important;" class="btn btn-link" href="{{ url('/resetear') }}">
                                    {{ __('T\'has oblidat la contrasenya?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>