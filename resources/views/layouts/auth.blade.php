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

    <header class="login-cabecalho">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="{{ route('principal') }}">
                        <img class="img-fluid  logo-login-cadastro" src="{{asset('images/PowerCar-carro.png')}}" alt="Logo PowerCar Repair">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <section class="login-conteudo">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-5 mx-auto">

                    <!-- Incluindo o conteudo -->
                    <main class="">
                        @yield('content')
                    </main>

                </div>
            </div>
        </div>
    </section>

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
