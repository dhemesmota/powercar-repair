<div>
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="titulo-conteudo mb-4">Agendamentos</h4>
        </div>
        <div class="col-md-12">
            @if (isset($agendamentos))

                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach ($columnList as $key => $value)
                                    <th scope="col">{{ $value }}</th>      
                                @endforeach
                                <th scope="col" class="text-right">{{ __('linguagem.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendamentos as $key => $value)
                            <tr>
                                @foreach ($columnList as $key2 => $value2)
                                    @if ($key2 == 'id')
                                        <th scope="row">@php echo $value->{$key2} @endphp</th>
                                    @elseif($key2 == 'description')
                                        <td>
                                            <button class="btn text-secondary" onclick="scheduling('{{ $value->{$key2} }}')" data-toggle="modal" data-target="#modalDescriptionScheduling">
                                                <i class="fas fa-file-alt fa-2x"></i>
                                            </button>
                                        </td>
                                    @elseif($key2 == 'name')
                                        <td>
                                            @if($value->{$key2} == "Aprovado")
                                                <i class="fab fa-font-awesome-flag text-@php echo $value->color @endphp" style="cursor: pointer;" data-toggle="modal" data-target="#modalApproveScheduling"></i> @php echo $value->{$key2} @endphp
                                            @else
                                                <i class="fab fa-font-awesome-flag text-@php echo $value->color @endphp"></i> @php echo $value->{$key2} @endphp
                                            @endif
                                        </td>
                                    @else
                                        <td>@php echo $value->{$key2} @endphp</td>
                                    @endif
                                @endforeach
                                <td class="text-right">
                                    
                                    @if ($value->name == "Pendente")
                                        @can('approve-scheduling')
                                            <a href="{{ route($routeName.'.approve',$value->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="@lang('linguagem.approve')">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @endcan
                                    @endif
        
                                    @if ($value->name == "Pendente" || $value->name == "Aprovado")
                                        @can('cancel-scheduling')
                                            <a href="{{ route($routeName.'.cancel',$value->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="@lang('linguagem.cancel')">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                        @endcan
                                    @endif
                                    
                                    @can('delete-scheduling')
                                        <a href="{{ route($routeName.'.show',[$value->id,'delete=1']) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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