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
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personalizado.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    
</head>
<body id="page-top">

    <!-- Navigation -->
    <header id="headerHome">
        <div class="container">
            <div class="row pt-4">
                <div class="d-flex w-100">
                    <div id="logoHome" class="col-md-6">
                        <a href="{{ route('principal') }}">
                            <img src="images/POWERCAR.png" alt="PowerCar" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-6">
                        @guest
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div id="loginSite" class="form-row text-right">
                                    <div class="form-group col-7">
                                        <label for="emailLogin"><i class="far fa-user"></i></label>
                                        <input name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="emailLogin" value="{{ old('email') }}" placeholder="@lang('linguagem.email')" minlength="6" maxlength="60" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="senhaLogin"><i class="fas fa-fingerprint"></i></label>
                                        <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="senhaLogin"
                                            placeholder="" minlength="6" maxlength="16" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-powercar">
                                        @lang('linguagem.login')
                                    </button>
                                </div>
                                <div id="linksHomeHeader" class="form-row d-flex align-items-center justify-content-end">
                                    <a href="{{ route('register') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Criar uma conta">@lang('linguagem.register')</a>
                                    <span class="text-white">|</span>
                                    <a class="nav-link" href="{{ route('password.request') }}" data-toggle="tooltip" data-placement="bottom" title="Clique para recuperar a senha">@lang('linguagem.forgot_your_password')</a>
                                </div>
                            </form>
                        @else
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link  text-secondary" href="{{ route('profile.index') }}">
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        @lang('linguagem.logout')
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </div>
                <div class="col-12">
                    <ul id="navbarHome" class="nav justify-content-center align-items-center my-4 p-1">
                        @guest
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="fas fa-calendar-day"></i> Agendamento</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> {{ __('linguagem.dashboard') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="fas fa-calendar-day"></i> Agendamento</a>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a href="{{ route('lang') }}" class="nav-link"><i class="fas fa-language"></i> @lang('linguagem.lang')
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="apresentacaoHome" class="col-md-6 mt-3">
                    <h2 class="mb-3">Sua oficina mecânica PowerCar</h2>
                    <h5 class="mb-3">Todos os serviços em um só lugar</h5>
                    <p class="text-justify">Aqui você conta com a conveniência de encontrar todos os serviços que o seu carro necessita em um só lugar. Oferecemos o melhor em mecânica automotiva, sistemas elétricos e eletrônicos, injeção eletrônica, regulagem de motores, pneus, alinhamento e balanceamento, troca de óleo e filtros, câmbios automáticos, serviços de suspensão e freios.</p>
                    <div class="text-center">
                        <button class="btn btn-success green btn-lg my-4">Agendamento</button>
                    </div>
                </div>
                <div id="imagemHome" class="col-md-6">
                    <img class="img-fluid" src="images/motor-de-carro-png-3.png" alt="">
                </div>
            </div>
        </div>
    </header>



    <!-- Incluindo o conteudo -->
    <main class="">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="rodape">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{asset('images/PowerCar-carro.png')}}" alt="PowerCar" class="img-fluid">
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 mx-auto my-4">
                            <div class="row">
                                <div class="col-4">
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <i class="fab fa-facebook fa-2x"></i>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="https://www.instagram.com/?hl=pt-br" target="_blank">
                                        <i class="fab fa-instagram fa-2x"></i>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="https://twitter.com/" target="_blank">
                                        <i class="fab fa-twitter-square fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p>@lang('linguagem.copyright') © 
                    @php
                        echo date('Y'); // Pegando o ano atual
                    @endphp, PowerCar Repair</p>
                </div>
            </div>
        </div>
    </footer>

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
