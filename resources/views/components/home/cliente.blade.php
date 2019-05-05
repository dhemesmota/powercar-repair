<div>
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="titulo-conteudo mb-4">Agendamentos</h4>
        </div>
        <div class="col-md-12">
            @if (isset($agendamentos))
                <h1>Tem agendamentos</h1>
            @else
            
                <div class="bg-light rounded w-100 py-4 d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-column">
                        <span class="text-secondary my-4">Nenhum agendamento solicitado.</span>
                        <div class="text-center">
                            <a href="#" class="btn btn-powercar">
                                <i class="fas fa-calendar-plus"></i> Solicitar
                            </a>
                        </div>
                    </div>
                </div>
            
            @endif
        </div>
        <div class="col-12 mt-5">
            <h4 class="titulo-conteudo mb-4">Atendimentos</h4>
        </div>
        <div class="col-md-12">
            @if (isset($agendamentos))
                <h1>Tem atendiemnto</h1>
            @else
            
                <div class="bg-light rounded w-100 py-4 d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-column">
                        <span class="text-secondary my-4">Nenhum atendimento para listar.</span>
                    </div>
                </div>
            
            @endif
        </div>
    </div>
</div>