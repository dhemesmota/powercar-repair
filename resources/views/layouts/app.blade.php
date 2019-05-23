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
    <header class="nav-cabecalho container-fluid px-0">
        <div class="row mx-0 px-0">
            <div id="navLogo" class="logo-admin">
                <a href="{{ route('home') }}">
                    <img class="img-fluid" src="{{asset('images/POWERCAR.png')}}" alt="PowerCar">
                </a>
            </div>
            <div class="col px-0 mx-0 nav-menu border-bottom">
                <div class="ml-4" onclick="MostrarEsconderDiv()" style="cursor:pointer;">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="ml-auto mr-2 text-white">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="text-dark">
                        <i class="fas fa-sign-out-alt"></i>
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
        </div>
    </header>

    <!-- Conteudo Principal -->
    <div id="main" class="row container-fluid">
        <section id="menuLateral" class="">
            <div class="container-fluid px-0">
                <!-- Perfil -->
                <a  href="{{ route('profile.index') }}" class="perfil-menu my-4">
                    <div>
                        <figure class="text-center">
                            <img class="img-fluid img-menu" src="{{Auth::user()->image}}">
                        </figure>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <span class="small">@lang('linguagem.welcome')</span>
                        <small class="">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </small>
                    </div>
                </a><!-- Fim Perfil-->

                <nav id="navBarLateral" class="nav flex-column">
                    @if (Request::segment(1) == 'home')
                        @php
                            $home = "active";
                        @endphp
                    @endif
                    <a href="{{ route('home') }}" class="nav-link {{ isset($home) ? $home : '' }}">
                        <i class="fas fa-tachometer-alt navIcone fa-2x"></i>
                        <span class="nav-titulo">
                            @lang('linguagem.dashboard')
                        </span>
                    </a>

                    @can('list-scheduling')
                        @if (Request::segment(2) == 'schedulings')
                            @php
                                $schedulings = "active";
                            @endphp
                        @endif
                        <a href="{{ route('schedulings.index') }}" class="nav-link {{ isset($schedulings) ? $schedulings : '' }}">
                            <i class="fas fa-calendar-alt navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.scheduling')</span>
                        </a>
                    @endcan

                    @can('list-budget')
                        @if (Request::segment(2) == 'budgets')
                            @php
                                $budgets = "active";
                            @endphp
                        @endif
                        <a href="#" class="nav-link {{ isset($budgets) ? $budgets : '' }}">
                            <i class="fas fa-wrench navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.budget')</span>
                        </a>
                    @endcan

                    @can('list-vehicle')
                        @if (Request::segment(2) == 'vehicles')
                            @php
                                $vehicles = "active";
                            @endphp
                        @endif
                        <a href="{{ route('vehicles.index') }}" class="nav-link {{ isset($vehicles) ? $vehicles : '' }}">
                            <i class="fas fa-car-alt navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.vehicle')</span>
                        </a>
                    @endcan
                    
                    @can('list-order-service')
                        <a href="#" class="nav-link">
                            <i class="fas fa-tools navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.order_of_service')</span>
                        </a>
                    @endcan

                    @can('list-employees')
                        @if (Request::segment(2) == 'employees')
                            @php
                                $employees = "active";
                            @endphp
                        @endif
                        <a href="{{ route('employees.index') }}" class="nav-link {{ isset($employees) ? $employees : '' }}">
                            <i class="fas fa-user-cog navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.employees')</span>
                        </a>
                    @endcan

                    @can('list-client')
                        @if (Request::segment(2) == 'clients')
                            @php
                                $clients = "active";
                            @endphp
                        @endif
                        <a href="{{ route('clients.index') }}" class="nav-link {{ isset($clients) ? $clients : '' }}">
                            <i class="fas fa-user-tie navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.customers')</span>
                        </a>
                    @endcan

                    @can('list-products-and-services')
                        @if (Request::segment(2) == 'products' or Request::segment(2) == 'services')
                            @php
                                $p_and_s = "show";
                            @endphp
                        @endif
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProSer" aria-expanded="false" aria-controls="collapseOneProSer">
                            <i class="fas fa-cubes navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.products_and_services')</span>

                            <i class="fas fa-angle-down seta"></i>
                        </a>
                        <div id="collapseProSer" class="collapse {{ isset($p_and_s) ? $p_and_s : '' }}" aria-labelledby="collapseOneProSer" data-parent="#navBarLateral">
                            <div class="card-body ml-4">
                                @if (Request::segment(2) == 'products')
                                    @php
                                        $products = "active2";
                                    @endphp
                                @endif
                                <a href="{{ route('products.index') }}" class="nav-link {{ isset($products) ? $products : '' }}">
                                    <i class="fas fa-box"></i>
                                    <span class="nav-titulo">@lang('linguagem.products')</span>
                                </a>
                                @if (Request::segment(2) == 'services')
                                    @php
                                        $services = "active2";
                                    @endphp
                                @endif
                                <a href="{{ route('services.index') }}" class="nav-link {{ isset($services) ? $services : '' }}">
                                    <i class="fas fa-wrench"></i>
                                    <span class="nav-titulo">@lang('linguagem.services')</span>
                                </a>
                            </div>
                        </div>
                    @endcan
                    @if ((Auth::user()->can('list-user')) or (Auth::user()->can('acl')))
                        @if (Request::segment(2) == 'users' or Request::segment(2) == 'roles' or Request::segment(2) == 'permissions' or Request::segment(2) == 'situations')
                            @php
                                $settings = "show";
                            @endphp
                        @endif
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePermissoes" aria-expanded="false" aria-controls="collapseOnePermissoes">
                            <i class="fas fa-cogs navIcone fa-2x"></i>
                            <span class="nav-titulo">@lang('linguagem.settings')</span>

                            <i class="fas fa-angle-down seta"></i>
                        </a>
                        <div id="collapsePermissoes" class="collapse {{ isset($settings) ? $settings : '' }}" aria-labelledby="collapseOnePermissoes" data-parent="#navBarLateral">
                            <div class="card-body ml-4">
                                @can('list-user')
                                    @if (Request::segment(2) == 'users')
                                        @php
                                            $users = "active2";
                                        @endphp
                                    @endif
                                    <a href="{{ route('users.index') }}" class="nav-link {{ isset($users) ? $users : '' }}">
                                        <i class="fas fa-users"></i>
                                        <span class="nav-titulo">
                                            @lang('linguagem.users')
                                        </span>
                                    </a>
                                @endcan
                                @can('acl')
                                    @if (Request::segment(2) == 'roles')
                                        @php
                                            $roles = "active2";
                                        @endphp
                                    @endif
                                    <a href="{{ route('roles.index') }}" class="nav-link {{ isset($roles) ? $roles : '' }}">
                                        <i class="fas fa-user-circle"></i>
                                        <span class="nav-titulo">
                                            @lang('linguagem.role_list')
                                        </span>
                                    </a>
                                @endcan
                                @can('acl')
                                    @if (Request::segment(2) == 'permissions')
                                        @php
                                            $permissions = "active2";
                                        @endphp
                                    @endif
                                    <a href="{{ route('permissions.index') }}" class="nav-link {{ isset($permissions) ? $permissions : '' }}">
                                        <i class="fas fa-lock-open"></i>
                                        <span class="nav-titulo">
                                            @lang('linguagem.permission_list')
                                        </span>
                                    </a>
                                @endcan
                                @can('acl')
                                    @if (Request::segment(2) == 'situations')
                                        @php
                                            $situations = "active2";
                                        @endphp
                                    @endif
                                    <a href="{{ route('situations.index') }}" class="nav-link {{ isset($situations) ? $situations : '' }}">
                                        <i class="fab fa-font-awesome-flag"></i>
                                        <span class="nav-titulo">@lang('linguagem.situations')</span>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="fas fa-sign-out-alt navIcone fa-2x"></i>
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

        <section id="conteudoMain" class="col container-fluid">

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

    <script src="{{ asset('js/jquery.mask.js') }}"></script>

    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })

        // Mascaras de input
        $(document).ready(function(){

            MostrarEsconderDiv = function(){
                $("#menuLateral").toggle(200);
                $("#navLogo").toggle(200);
            }


            $('.date').mask('11/11/1111');
            $('.year').mask('0000/0000');
            $('.time').mask('00:00:00');
            $('.value').mask('0.000,00', {reverse: true});
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.zip_code').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.phone_with_ddd').mask('(00) 0000-0000');
            $('.telephone').mask('(00) 00000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            $('.board').mask('AAAAAAA');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});
        });

        // Exibir o nome da imagem no campo email
        $('.custom-file-input').on('change',function(){
            var fileName = $(this).val().split("\\").pop();
            //console.log(fileName);
            document.getElementById('labelImage').innerText = fileName;
        })

        function previewFile(e) {
            var preview = document.querySelector('.preview');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                document.getElementById('inputImage').setAttribute('value', reader);
                console.log(reader);
            } else {
                preview.src = "";
            }
        }
    </script>
</body>
</html>
