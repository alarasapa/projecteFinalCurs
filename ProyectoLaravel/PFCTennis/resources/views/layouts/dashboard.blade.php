<!DOCTYPE html>
<html>
<head>
    <title>@yield('titol')</title> 

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- En el stack se añadirá de forma dinámica el archivo CSS de la página correspondiente -->
    @stack('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body onload="init()">  
    @if (!Auth::check() || (Auth::user()->rol != 'A'))
        <script>
            location.href = '/index';
        </script>
    @endif

    <script>
        function init(){
            $("#sidebarToggle").on("click", function(e) {
                e.preventDefault();
                $("body").toggleClass("sb-sidenav-toggled");
            });
        }
    </script>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('index') }}">RAQUETA</a>
        
        <button class="btn d-lg-none btn-link btn-sm order-1 order-lg-0" data-toggle="collapse" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>            

        <h1 style="color: white;">DASHBOARD DE L'USUARI: {{ Auth::user()->nom }}</h1>

        <ul class="navbar-nav justify-content-end ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{ Auth::user()->nom }}</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('home') }}">Configuracio</a>
                    <a class="dropdown-item" href="#">Últimes accions</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Tancar Sessió</a>
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf   
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="collapsibleNavbar">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Altres</div>
                        <a class="nav-link {{ rutaActual('dashboard') }}" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-exclamation-circle"></i></div>
                            Peticions
                        </a>
                        <div class="sb-sidenav-menu-heading">Gestions</div>
                        <a class="nav-link collapsed {{ rutaActual('gestioUsuaris') }}" href="#" data-toggle="collapse" data-target="#collapseUsuarios" >
                            <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                            Usuaris
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsuarios">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ rutaActual('gestioUsuaris') }}" href="{{ route('gestioUsuaris') }}">Gestió General</a>
                                <a class="nav-link {{ rutaActual('dashboard/gestio/usuaris/nouUsuari')}}" href="{{ route('formulariUsuari', ['accio' => 'nouUsuari']) }}">Crear Usuari</a>
                                <!-- <a class="nav-link" href="#">Light Sidenav</a> -->
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaginas" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pàgines
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePaginas">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed {{ rutaActual('dashboard/gestio/slider') }}" href="{{ route('slider') }}" aria-expanded="false">Slider</a>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content') @section('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>