<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'NetProvider')
    </title>

    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}" />
</head>
<style>
    body {
        font-family: arial;
    }
</style>
<body id="" style="margin-top:3em;">
    @if(Auth::check())
    <nav class="my-navbar navbar fixed-top navbar-expand-lg 
    navbar-light shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{BASE_URL}}/">
            <img src="{{BASE_URL}}/images/logo.png" width="20px" 
            alt="{{ config('app.name', 'Laravel') }}" style="display:inline">

        </a>

        </span>

        <button  class="navbar-toggler text-white" style="font-size: 23px; padding: 0; border: 0" type="button" 
        data-toggle="collapse" data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" 
        aria-label="{{ __('Toggle navigation') }}">
            <i class="fa fa-bars"></i> 
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            
           
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('register') }}">{{ __('Regista-te') }}</a>
                    </li>
                @endif
            @else
            @if(Auth::check() && Auth::user()->role <= 2) 
                <li class="nav-item">
                    
                    <a class="nav-link active" href="{{BASE_URL}}/admin">
                        <i class="fas fa-tachometer-alt"></i> DashBoard
                    </a>
                    
                </li>
                @endif

            @endguest

          </ul>
          <!--<a href="#" onclick="openSearch()" 
            style="font-size: 23px" class="ml-2" >
              <i class="fa fa-search"></i>
          </a>-->
            @if(Auth::check())
                <a class="nav-link active" href="{{BASE_URL}}/profile">
                    Minha Conta
                    <span class="caret"></span>
                </a>
            @endif
        </div>
        </div>
      </nav>
      @endif
    <div id="">

        <div class="py-1">
            @yield('content')
        </div>

        <div id="success" class="text-white"></div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/input-mask.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
