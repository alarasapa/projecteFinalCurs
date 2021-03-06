<!DOCTYPE html>
<html>
<head>
    <title>@yield('titol')</title> 

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- En el stack se añadirá de forma dinámica el archivo CSS de la página correspondiente -->
    @stack('css')
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script> 

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" />
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

   

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
        <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ url('imatges/soci/logo.png') }}" width="60"></a>
        
        <button class="btn d-lg-none btn-link btn-sm order-1 order-lg-0" data-toggle="collapse" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>            

        <!-- <h1 style="color: white;">DASHBOARD DE: {{ Auth::user()->nom }}</h1> -->

        <ul class="navbar-nav ml-auto float-md-right">
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
                        <a class="nav-link collapsed {{ rutaActual('dashboard/gestio/usuaris*') }}" href="#" data-toggle="collapse" data-target="#collapseUsuarios" >
                            <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                            Usuaris
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsuarios">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('usuaris.gestioUsuaris') }}">Gestió General</a>
                                <a class="nav-link" href="{{ route('usuaris.formulariUsuari', ['accio' => 'nouUsuari']) }}">Crear Usuari</a>
                                <!-- <a class="nav-link" href="#">Light Sidenav</a> -->
                            </nav>
                        </div>
                        
                        <a class="nav-link collapsed {{ rutaActual('dashboard/gestio/vista*') }}" href="#" data-toggle="collapse" data-target="#collapsePaginas" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pàgines
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePaginas">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paginesInici" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Inici
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="paginesInici" data-parent="#sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="{{ route('slider') }}">Slider</a>
                                    <a class="nav-link collapsed" href="{{ route('cartes') }}">Cartes</a>
                                </div>
                                
                            </nav>
                        </div>

                        <a class="nav-link collapsed {{ rutaActual('dashboard/gestio/activitats*') }}" href="#" data-toggle="collapse" data-target="#collapseActivitats" aria-controls="collapseActivitats">
                            <div class="sb-nav-link-icon"><i class="fa fa-briefcase"></i></div>
                            Activitats
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseActivitats">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="{{ route('activitats.tipusActivitats') }}">Categories</a>
                                <a class="nav-link" href="{{ route('activitats.activitats') }}">Activitats</a>
                                <a class="nav-link" href="{{ route('activitats.extres') }}">Extres</a>
                                <!-- <a class="nav-link" href="{{ route('activitats.grupopcions', ['tipus' => 'extres']) }}">Grup Opcions Extres</a> -->
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="session-status">
                    @include('layouts.session-status')
                </div>
                
                @yield('content') @section('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>