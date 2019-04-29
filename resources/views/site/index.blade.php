@extends('layouts.site')

@section('content')

    <!-- Header -->
    <section id="servicos">
        <div class="container">
            <div class="row mb-5 p-3">
                <div class="col-12 my-4">
                    <h5 class="text-center titulo-topico">Serviços</h5>
                </div>
                <div class="mb-4 row">
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Troca-de-Oleo-e-Lubrificantes.jpg" class="card-img-top" alt="...">                            
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Troca de Óleo e Lubrificantes</h5>
                                <p class="card-text">Óleo e filtro de óleo, lubrificantes de freio e muito mais.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Diagnostico-e-regulagem-de-sistemas-de-injecao.jpg" class="card-img-top" alt="...">                            
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Sistemas de Injeção</h5>
                                <p class="card-text">Diagnóstico e regulagem de sistemas de injeção Gasolina, Flex ou Diesel.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Regulagem-de-Motores.jpg" class="card-img-top" alt="...">                            
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Regulagem de Motores</h5>
                                <p class="card-text">Diagnóstico eletrônico e equipamentos de última tecnologia para garantir o funcionamento.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Alinhamento-e-Balanceamento.jpg" class="card-img-top" alt="...">                        
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Alinhamento e Balanceamento</h5>
                                <p class="card-text">Garanta a segurança e dirigibilidade de seu veículo com a melhor tecnologia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Sistemas-de-Freios.jpg" class="card-img-top" alt="...">                            
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Sistemas de Freios</h5>
                                <p class="card-text">Regulagem do sistema e substituição de pastilhas, pinças e discos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Suspensao.jpg" class="card-img-top" alt="...">      
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Suspensão</h5>
                                <p class="card-text">Regulagem e manutenção do sistema completo para garantir o melhor funcionamento.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Mecanica-Geral.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Mecânica Geral</h5>
                                <p class="card-text">Precisando de manutenção ou de revisão? Nossa equipe de especialistas está pronta para
                                    auxiliar.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-servicos mb-3 mb-md-4 col-md-3">
                        <div class="card">
                            <div class="zoom">
                                <img src="images/Ar-condicionado.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Ar-condicionado</h5>
                                <p class="card-text">Manutenção e diagnóstico do sistema para garantir a melhor performance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Avaliações de Clientes -->
    <section id="avaliacoesClientes" class="mb-5">
        <div id="fundoSlideAvaliacoes" class="mb-4">
            <div id="slideAvaliacoes">
                <div class="container-fluid">
                    <div class="row">
                        <div id="carroselAvaliacoes" class="col-12 d-flex align-items-center">
                            <div class="w-100">
                                <div id="carouselAvaliacoes" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="avaliacao">
                                                <p>"A PowerCar Repair está de parabéns pelo ótimo atendimento e serviço de qualidade. A praticidade de acompanhar todo
                                                processo de concerto do meu veículo é incrível."</p>
                                                <span>Cliente - Jhon</span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="avaliacao">
                                                <p>"A PowerCar Repair está de parabéns pelo ótimo atendimento e serviço de qualidade."</p>
                                                <span>Cliente - Junior</span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="avaliacao">
                                                <p>"A praticidade de acompanhar todo
                                                    processo de concerto do meu veículo é incrível."</p>
                                                <span>Cliente - Alexandre</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselAvaliacoes" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselAvaliacoes" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo Marcas -->
    <section id="marcas">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5 my-4">
                    <h5 class="text-center titulo-topico">Marcas</h5>
                </div>
                <div class="col-12 px-0 mx-0 mb-2 mb-md-4 row">
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/BMW.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/honda.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/mercedes-benz.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/Hyundai.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/Ford.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/Fiat.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/Citroen.jpg" alt="BMW">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-4 marcasLogos">
                        <div class="card p-2">
                            <img class="" src="images/marcas/vw.jpg" alt="BMW">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre a Empresa -->
    <section id="sobre">
        <div class="container">
            <div class="row my-5">
                <div class="col-md-6">
                    <img class="img-fluid" src="images/motor-de-carro-png.png" alt="">
                </div>
                <div class="col-md-6">
                    <h5 class="text-center titulo-topico text-dark my-4">Sobre nós</h5>
                    <p class="text-justify">Fundada em 2003, a PowerCar
                        Repair, oficina mecânica autorizada, é referência no mercado de reparação
                        automotiva em Brasília - DF. Sua equipe de profissionais é constantemente
                        treinada com as principais especificações técnicas dos fabricantes automotivos
                        afim de manter seu compromisso com a excelência, desenvolvimento e a evolução
                        continua dos serviços prestados.</p>
                    <div class="text-center">
                        <button class="btn btn-success green btn-lg my-4" data-toggle="modal" data-target="#sobreEmpresa">Leia mais</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Sobre a Empresa -->
    <div class="modal fade" id="sobreEmpresa" tabindex="-1" role="dialog" aria-labelledby="sobreEmpresaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sobreEmpresaLabel">PowerCar Repair</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-justify">Fundada em 2003, a PowerCar
                            Repair, oficina mecânica autorizada, é referência no mercado de reparação
                            automotiva em Brasília - DF.</p>
                            <p class="text-justify">Sua equipe de profissionais é constantemente
                            treinada com as principais especificações técnicas dos fabricantes automotivos
                            afim de manter seu compromisso com a excelência, desenvolvimento e a evolução
                            continua dos serviços prestados.</p>
                            <p class="text-justify">Somos referência em Brasília, contando com mais de 5 oficinas.</p>
                        </div>
                        <div class="col-md-6">
                            <img class="img-fluid" src="{{ asset('images/motor-de-carro-png-3.png') }}" alt="">
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="col-md-4 mb-2 px-1 card-sobre">
                            <img class="img-fluid" src="{{ asset('images/Alinhamento-e-Balanceamento.jpg') }}" alt="">
                        </div>
                        <div class="col-md-4 mb-2 px-1 card-sobre">
                            <img class="img-fluid" src="{{ asset('images/Ar-condicionado.jpg') }}" alt="">
                        </div>
                        <div class="col-md-4 mb-2 px-1 card-sobre">
                            <img class="img-fluid" src="{{ asset('images/Diagnostico-e-regulagem-de-sistemas-de-injecao.jpg') }}" alt="">
                        </div>
                        <div class="col-md-4 mb-2 px-1 card-sobre">
                            <img class="img-fluid" src="{{ asset('images/Mecanica-Geral.jpg') }}" alt="">
                        </div>
                        <div class="col-md-4 mb-2 px-1 card-sobre">
                            <img class="img-fluid" src="{{ asset('images/Sistemas-de-Freios.jpg') }}" alt="">
                        </div>
                        <div class="col-md-4 mb-2 px-1 card-sobre">
                            <img class="img-fluid" src="{{ asset('images/Troca-de-Oleo-e-Lubrificantes.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('linguagem.close')</button>
                </div>
            </div>
        </div>
    </div>

@endsection
