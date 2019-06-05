<div class="row mb-4">
    <div class="col-12">
        <h3 class="titulo-conteudo text-title mb-4">Meus Serviços</h3>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="card-left gradiente-azul">
                            <div class="card-fundo-title">
                                <span>Novas OS</span>
                            </div>
                        </div>
                        <div class="card-right text-title">
                            <h1>{{ $osNova }}</h1>
                            <span class="text-secondary"><i class="fas fa-chart-line"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="card-left gradiente-verde">
                            <div class="card-fundo-title">
                                <span>OS Pendente</span>
                            </div>
                        </div>
                        <div class="card-right text-title">
                            <h1>{{ $osPendente }}</h1>
                            <span class="text-secondary"><i class="fas fa-circle"></i> Aguardando aprovação do cliente</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="card-left gradiente-vermelho">
                            <div class="card-fundo-title">
                                <span>OS Total</span>
                            </div>
                        </div>
                        <div class="card-right text-title">
                            <h1>{{ $osConcluida }}</h1>
                            <span class="text-secondary">...</span>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="titulo-conteudo text-title mb-4">Últimos Serviços</h3>
            </div>
            <div class="col-md-6">  
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="col-12">
                        <table  class="table table-hover">
                            <thead id="ultimosServicosThead" class="border-top">
                                <tr class="text-secondary">
                                    @foreach ($columnListBudgets as $key => $value)
                                        <th scope="col">{{ $value }}</th>      
                                    @endforeach
                                    <th scope="col" class="text-right">{{ __('linguagem.action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="ultimosServicosTbody">
                                @php
                                    $isClient = auth()->user()->isClient();
                                @endphp
                                @foreach ($budgets as $key => $value)
                                <tr>
                                        @foreach ($columnListBudgets as $key2 => $value2)
                                            @if ($key2 == 'id')
                                                <th scope="row">{{ $value->$key2 }}</th>
                                            @elseif($key2 == 'model')
                                                <td class="text-center">
                                                    @if (empty($value->{$key2}))    
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>