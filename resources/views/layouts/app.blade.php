<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css" rel="stylesheet') }}" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personalizado.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    
</head>
<body id="page-top">

    <!-- Navigation -->
    <header class="nav-cabecalho container-fluid">
        <span class="d-flex w-100">
            <div class="logo-admin">
                <a href="{{ route('home') }}">
                    <img class="img-fluid" src="{{asset('images/POWERCAR.png')}}" alt="PowerCar">
                </a>
            </div>
            <div class="nav-menu ml-auto">
                <div class="ml-4 mr-2 text-white">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="text-dark">
                        <i class="fas fa-power-off"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>

                <div class="ml-0 mr-4 text-dark text-uppercase">
                    <a href="{{ route('lang') }}" class="text-dark nav-link">
                        @lang('linguagem.lang')
                    </a>
                </div>
            </div>
        </span>
    </header>

    <!-- Conteudo Principal -->
    <div id="main">
        <section id="menuLateral">
            <div class="container-fluid">
                <!-- Perfil -->
                <a  href="#" class="perfil-menu my-4">
                    <div>
                        <figure class="mr-2 text-center">
                            <img class="img-fluid img-menu" src="{{asset('images/perfil.jpg')}}" alt="Chaplin">
                            <figcaption class="small">Gerente</figcaption>
                        </figure>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <span class="small">Bem vindo!</span>
                        <small class="">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </small>
                    </div>
                </a><!-- Fim Perfil-->

                <nav id="navBarLateral" class="nav flex-column">
                    <a href="{{ route('home') }}" class="nav-link active">
                        <i class="fas fa-tachometer-alt navIcone"></i>
                        <span class="nav-titulo">
                            @lang('linguagem.dashboard')
                        </span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-alt navIcone"></i>
                        <span class="nav-titulo">Agendamento</span>
                    </a>
                    
                    <a href="#" class="nav-link">
                        <i class="fas fa-tools navIcone"></i>
                        <span class="nav-titulo">Ordem de Serviço</span>
                    </a>

                    <a href="#" class="nav-link">
                        <i class="fas fa-user-cog navIcone"></i>
                        <span class="nav-titulo">Funcionários</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-tie navIcone"></i>
                        <span class="nav-titulo">Clientes</span>
                    </a>

                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProSer" aria-expanded="false" aria-controls="collapseOneProSer">
                        <i class="fas fa-cubes navIcone"></i>
                        <span class="nav-titulo">Produtos e Serviços</span>

                        <i class="fas fa-angle-down seta"></i>
                    </a>
                    <div id="collapseProSer" class="collapse" aria-labelledby="collapseOneProSer" data-parent="#navBarLateral">
                        <div class="card-body ml-4">
                            <a href="#" class="nav-link">
                                <i class="fas fa-box"></i>
                                <span class="nav-titulo">Produtos</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="fas fa-wrench"></i>
                                <span class="nav-titulo">Serviços</span>
                            </a>
                        </div>
                    </div>
                    @if ((Auth::user()->can('list-user')) or (Auth::user()->can('acl')))
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePermissoes" aria-expanded="false" aria-controls="collapseOnePermissoes">
                            <i class="fas fa-cogs navIcone"></i>
                            <span class="nav-titulo">Configurações</span>

                            <i class="fas fa-angle-down seta"></i>
                        </a>
                        <div id="collapsePermissoes" class="collapse" aria-labelledby="collapseOnePermissoes" data-parent="#navBarLateral">
                            <div class="card-body ml-4">
                                @can('list-user')
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="fas fa-users"></i>
                                        <span class="nav-titulo">
                                            @lang('linguagem.users')
                                        </span>
                                    </a>
                                @endcan
                                @can('acl')
                                    <a href="{{ route('roles.index') }}" class="nav-link">
                                        <i class="fas fa-user-circle"></i>
                                        <span class="nav-titulo">
                                            @lang('linguagem.role')
                                        </span>
                                    </a>
                                @endcan
                                @can('acl')
                                    <a href="{{ route('permissions.index') }}" class="nav-link">
                                        <i class="fas fa-lock-open"></i>
                                        <span class="nav-titulo">
                                            @lang('linguagem.permission')
                                        </span>
                                    </a>
                                @endcan
                                <a href="#" class="nav-link">
                                    <i class="fab fa-font-awesome-flag"></i>
                                    <span class="nav-titulo">Situações</span>
                                </a>
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="fas fa-sign-out-alt navIcone"></i>
                        <span class="nav-titulo">
                            @lang('linguagem.logout')
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </nav>
            </div>
        </section>

        <section id="conteudoMain" class="container-fluid">

            <main class="">
                @yield('content')
            </main>            
            
            <!-- Footer -->
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-5 mb-2 text-center text-secondary">
                            <small class="my-2">@lang('linguagem.copyright') © 
                            @php
                                echo date('Y'); // Pegando o ano atual
                            @endphp, PowerCar Repair</small>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/all.js') }}"></script>

    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>
