<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titol')</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    @if (!Auth::check())
        <script>
            location.href = '/index';
        </script>
    @endif

    <nav id="sidebarMenu" class="collapse navbar-expand-lg sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <!-- Collapse 1 -->
        <a
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true"
          data-mdb-toggle="collapse"
          href="#collapseExample1"
          aria-expanded="true"
          aria-controls="collapseExample1"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i>
        </a>
        <!-- Collapsed content -->
        <ul id="collapseExample1" class="collapse show list-group list-group-flush">
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
        </ul>

        <!-- Collapsed content -->
        <ul id="collapseExample2" class="collapse list-group list-group-flush">
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
        </ul>
        <!-- Collapse 2 -->
      </div>
    </div>
  </nav>
            <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-left">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-fill w-100">  
                        <li class="nav-item">
                            <h4>Menú de {{ Auth::user()->nom }}</h4>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/index') }}">Tornar</a>
                        </li>

                        <li class="nav-item">
                            <a href="#">Configuració</a><br />
                        </li>

                        <li class="nav-item">
                            <a href="#">Llistat Matricules</a><br />
                        </li>

                        <li class="nav-item">
                            <a class="" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Tancar Sessió') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>  
                </div>
            </nav> -->

    </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
