<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sessió</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <a class="navbar-brand" href="{{ url('/') }}">Tornar</a>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Iniciar Sessió al club') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="usuariEmail" class="col-md-4 col-form-label text-md-right">{{ __('Adreça Email/Nom usuari') }}</label>

                                <div class="col-md-6">
                                    <input id="usuariEmail" type="text" name="usuariEmail" value="{{ old('usuariEmail') }}" required autofocus>
                                    <!-- class="form-control @error('email') is-invalid @enderror" -->
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('Aquest usuari o email no és correcte o no existeix') }}</strong>
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
                                            <strong>{{ $message }}</strong>
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
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Entrar') }}
                                    </button>
                                    <!-- CAMBIAR LA RUTA DE CAMBIAR PASSWORD -->
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ url('/resetear') }}">
                                            {{ __('T\'has oblidat la contrasenya?') }}
                                        </a>
                                    @endif
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