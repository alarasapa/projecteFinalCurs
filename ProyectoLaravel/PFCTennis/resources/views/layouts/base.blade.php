<!DOCTYPE html>
<html>
<head>
    <title>@yield('titol')</title> 

    <!-- En el stack se añadirá de forma dinámica el archivo CSS de la página correspondiente -->
    @stack('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark justify-content-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
            <ul class="navbar-nav nav-fill w-100">    
                <li class="nav-item {{ Request::is('/') || Request::is('index') ? 'active' : '' }}">
                    <a href="{{ route('index') }}" class="nav-link">Inici</a>
                </li>
                <li class="nav-item dropdown-hover">
                    <a class="nav-link dropdown-toggle" href="#" id="activitatsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Activitats
                    </a>
                    <div class="dropdown-menu dropdown-hover-menu" aria-labelledby="activitatsDropdown">
                        <!-- <nav id="navbarActivitats" class="sb-sidenav-menu-nested nav"> -->
                            <a href="{{ route('reservar') }}" class="dropdown-item">Reservar</a>
                            <a href="{{ route('escola') }}" class="dropdown-item">Escola</a>
                            <a href="{{ route('casal') }}" class="dropdown-item">Casal</a>
                        <!-- </nav> -->
                    </div>     
                </li>
                <li class="nav-item {{ rutaActual('soci') }}">
                    <a href="{{ route('soci') }}" class="nav-link">Soci</a>
                </li>
                <li class="nav-item {{ rutaActual('contacte') }}">
                    <a href="{{ route('contacte') }}" class="nav-link">Contacte</a>
                </li>
                <li class="nav-item">
                    @if (Auth::check())
                    <div> 
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Hola {{ Auth::user()->nom }}!
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->rol == 'U' || Auth::user()->rol == 'S')
                            <!-- Veure on está apuntat y tal -->
                            <a class="dropdown-item" href="#">
                                {{ __('Llistat matricules') }}
                            </a>    
                            @elseif (isAdmin())
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                {{ __('Administrar pàgina') }}
                            </a>    
                            @endif
                            <!-- Configuració del propi usuari -->
                            <a class="dropdown-item" href="{{ route('home') }}">
                                {{ __('Configuració') }}
                            </a>

                            <!-- PER A TANCAR LA SESSIÓ -->
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Tancar Sessió') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                </li>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Iniciar sessió</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Registrar-se</a>
                </li>
                    </div>
                    @endif
            </ul>
        </div>
    </nav>
        
    @yield('content') @section('content')

    <footer class="page footer font-small">

        <div class="col item social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>

        <div class="footer-copyright text-center py-3" style="color: aliceblue;">© 2021 Copyright:
            Agustin Ezequiel Lara Sicilia
        </div>

    </footer>

    @stack('scripts')
</body>
</html>