<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Sistema de Compras e Vendas Online')
    </title>

    <!-- Scripts -->
    <script async src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('assets/js/jquery/dist/jquery.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script defer src="{{ asset('assets/js/jquery.inputmask.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body style="margin-top:3em; background: #eee">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/admin">{{ env('APP_NAME') }} - Central </a>
        
        <button class="navbar-toggler text-white" style="padding: 0; border: 0" type="button" 
        data-toggle="collapse" data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" 
        aria-label="{{ __('Toggle navigation') }}">
            <i class="fa fa-bars"></i>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{BASE_URL}}/admin/customers">Clientes</a>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="{{BASE_URL}}/admin/employers">Funcionários</a>
            </li>    

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-laptop"></i> Servidores</a>
                <div class="dropdown-menu dropdown-menu-right" 
                aria-labelledby="navbarDropdownMenuLink">
                <a href="<?= BASE_URL; ?>/admin/servers" class="nav-link text-dark"> Servidores</a>
                <a href="<?= BASE_URL; ?>/admin/pools" class="nav-link text-dark"> IPs POOL</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-file"></i> Carnês</a>
                <div class="dropdown-menu dropdown-menu-right" 
                aria-labelledby="navbarDropdownMenuLink">
                <a href="<?= BASE_URL; ?>/admin/carnes" class="nav-link text-dark"> Carnês</a>
                <a href="<?= BASE_URL; ?>/admin/carne/create" class="nav-link text-dark"> Criar Carnê</a>
                </div>
            </li>

            <li class="nav-item active">
            <a class="nav-link" href="{{BASE_URL}}/admin/equipamentos">Equipamentos</a>
            </li>  
            <li class="nav-item active">
            <a class="nav-link" href="{{BASE_URL}}/admin/planos">Planos</a>
            </li>   
          </ul>

           
          
          <ul class="navbar-nav ml-auto">
            
                <li class="nav-item">
                    <a class="nav-link" href="{{BASE_URL}}/"> <i class="fa fa-home"></i> Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{BASE_URL}}/admin/config">Configurações</a>
                </li>
            </ul>

        </div>
      </nav>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
</body>
</html>
