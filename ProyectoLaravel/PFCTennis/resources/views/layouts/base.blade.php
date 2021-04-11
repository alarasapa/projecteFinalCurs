<!DOCTYPE html>
<html>
<head>
    <title>@yield('titol')</title> 

    <!--En el stack se añadirá de forma dinámica el archivo CSS de la página correspondiente-->
    @stack('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark justify-content-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
            <ul class="navbar-nav nav-fill w-100">    
                <li class="nav-item">
                    <a href="/index" class="nav-link">Inici</a>
                </li>
                <li class="nav-item">
                    <a href="/soci" class="nav-link">Soci</a>
                </li>
                <li class="nav-item">
                    <a href="/reservar" class="nav-link">Reservar</a>
                </li>
                <li class="nav-item">
                    <a href="/escola" class="nav-link">Escola</a>
                </li>
                <li class="nav-item">
                    <a href="/casal" class="nav-link">Casal</a>
                </li>
                <li class="nav-item">
                    <a href="/contacte" class="nav-link">Contacte</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('login'))
                        <div>
                        @auth
                            <a href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Iniciar sessió</a>
                </li>
                            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Registrar-se</a>
                </li>
                            @endif
                        @endauth
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