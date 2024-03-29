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
        
                                    @if ($value->name == "Pendente")
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
                    <div class="text-right">
                        <span onclick="window.location.href='{{ route($routeName.'.index') }}'" class="badge badge-info" style="cursor:pointer;">Listar todos</span>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalDescriptionScheduling" tabindex="-1" role="dialog" aria-labelledby="modalDescriptionSchedulingTitle" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header py-2 cor-powercar text-light">
                                <h5 class="modal-title" id="modalDescriptionSchedulingTitle">
                                    @lang('linguagem.description')
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-justify">
                                <span id="descriptionScheduling"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalApproveScheduling" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content cor-powercar text-light">
                            <div class="modal-header border-0 py-0 pr-2">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <i class="far fa-check-circle fa-7x"></i>
                                <p>O seu agendamento foi aprovado, não se esqueça de levar o seu veículo na data e hora agendada.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function scheduling(description) {
                        var desScheduling = document.getElementById('descriptionScheduling');
                        desScheduling.innerHTML = description;
                    }
                </script>
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
            @if (isset($budgetsClient))
            <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach ($listBudgetsClient as $key => $value)
                                    <th scope="col">{{ $value }}</th>      
                                @endforeach
                                <th scope="col" class="text-right">{{ __('linguagem.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgetsClient as $key => $value)
                            <tr>
                                @foreach ($listBudgetsClient as $key2 => $value2)
                                    @if ($key2 == 'id')
                                        <th scope="row">{{ $value->$key2 }}</th>
                                    @elseif($key2 == 'model')
                                        <td class="text-center">
                                            @if (empty($value->{$key2}) and !auth()->user()->isClient())    
                                                <a href="{{ route('budgets.vehicle',[$value->id,$value->client_id]) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Veículo">
                                                    <i class="fas fa-car"></i>
                                                </a>
                                            @else
                                                {{ $value->{$key2} }}
                                            @endif
                                        </td>
                                    @elseif($key2 == 'name')
                                        <td>
                                            @if($value->{$key2} == "Aprovado")
                                                <i class="fab fa-font-awesome-flag text-@php echo $value->color @endphp" style="cursor: pointer;" data-toggle="modal" data-target="#modalApproveBudget"></i> @php echo $value->{$key2} @endphp
                                            @else
                                                <i class="fab fa-font-awesome-flag text-@php echo $value->color @endphp"></i> @php echo $value->{$key2} @endphp
                                            @endif
                                        </td>
                                    @elseif($key2 == 'total_price')
                                        <td>@php echo !empty($value->{$key2}) ? "R$ ".$value->{$key2} : ""; @endphp</td>
                                    @elseif($key2 == 'value')
                                        <td>@php echo "R$ ".$value->{$key2} @endphp</td>
                                    @elseif($key2 == 'created_at')
                                        <td>@php echo date('d/m/Y \a\s H\hi', strtotime($value->{$key2})) @endphp</td>
                                    @elseif($key2 == 'description')
                                        <td>
                                            <button class="btn text-secondary" onclick="budget('{{ $value->{$key2} }}')" data-toggle="modal" data-target="#modalDescriptionBudget">
                                                <i class="fas fa-file-alt fa-2x"></i>
                                            </button>
                                        </td>
                                    @else
                                        <td>@php echo $value->{$key2} @endphp</td>
                                    @endif
                                @endforeach
                                <td class="text-right">
                                    @can('show-budget')
                                        <a href="{{ route('budgets.show',$value->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <span onclick="window.location.href='{{ route('budgets.index') }}'" class="badge badge-info" style="cursor:pointer;">Listar todos</span>
                    </div>
                </div>
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