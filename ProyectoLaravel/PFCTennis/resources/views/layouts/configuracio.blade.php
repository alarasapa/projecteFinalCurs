<!doctype html>
<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titol')</title>
    
    @stack('css')
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

</head>
<body onload="init()">
    @if (!Auth::check())
        <script>
            location.href = '/index';
        </script>
    @endif

  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse collapse">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
    </button>

    <div class="position-sticky" id="collapsibleNavbar">
      <div class="list-group list-group-flush mx-5 mt-4">
        <a
          href="{{ route('index') }}"
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Tornar Inici</span>
        </a>
        
        @if ( isAdmin() )
          <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-fw me-1"></i><span>Adminstrar pàgina</span></a>
        @else 
          <a href="#" class="list-group-item list-group-item-action py-2 ripple {{ rutaActual('matricules') }}">
            <i class="fas fa-fw me-1"></i><span>Llistat matricules</span></a>
        @endif

        <a href="{{ route('home') }}" class="list-group-item list-group-item-action py-2 ripple {{ rutaActual('home') }}"
          ><i class="fas fa-chart fa-fw me-3"></i><span>Cambiar dades generals</span></a>

        <a href="{{ route('cambiarLocalitzacio') }}" class="list-group-item list-group-item-action py-2 ripple {{ rutaActual('configuracio/cambiarlocalitzacio') }}"
        ><i class="fas fa-chart fa-fw me-3"></i><span>Cambiar localització</span></a>

        <a href="{{ route('cambiarPassword') }}" class="list-group-item list-group-item-action py-2 ripple {{ rutaActual('configuracio/cambiarpassword') }}"
        ><i class="fas fa-chart fa-fw me-3"></i><span>Cambiar contrasenya</span></a>
      
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-line fa-fw me-3"></i><span>Tancar Sessió</span></a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        	@csrf
        </form>
      
      </div>
    </div>
  </nav>
  
  </div class="container">
    <div class="session-status">
      @include('layouts.session-status')
    </div>

    @yield('content')
  </div>

  @stack('scripts') 
</body>
</html>
