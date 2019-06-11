@extends('layouts.app')

@section('content')
    @page_component(['col'=>12,'page'=>__('linguagem.list',['page'=>$page])])

        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component

        <!-- Componente search -->
        @search_component(['routeName'=>$routeName,'search'=>$search,'permissionCreate'=>'create-budget'])
        @endsearch_component

        <!-- Componente tabela -->
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
                    @foreach ($list as $key => $value)
                    <tr>
                        @foreach ($columnList as $key2 => $value2)
                            @if ($key2 == 'id')
                                <th scope="row">{{ $value->$key2 }}</th>
                            @elseif($key2 == 'model')
                                <td class="text-center">
                                    @if (empty($value->{$key2}))    
                                        <a href="{{ route($routeName.'.vehicle',[$value->id,$value->client_id]) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Veículo">
                                            <i class="fas fa-car"></i>
                                        </a>
                                        @php
                                            $hasCar = false;
                                        @endphp
                                    @else
                                        {{ $value->{$key2} }}
                                        @php
                                            $hasCar = true;
                                        @endphp
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
                            <span class="d-flex flex-row justify-content-end">
                                @can('add-product-service')
                                    @if($value->name != "Cancelado")
                                        @if ($hasCar == true)
                                            <a href="{{ route($routeName.'.product',$value->id) }}" class="btn btn-success ml-1 btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Produtos">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                            <a href="{{ route($routeName.'.service',$value->id) }}" class="btn btn-success btn-sm ml-1" data-toggle="tooltip" data-html="true" title="Adicionar Serviços">
                                                <i class="fas fa-tools"></i>
                                            </a>
                                        @endif
                                    @endif
                                @endcan
                                @can('ap-os')
                                    @if(($isClient == true) and $value->name != "Aprovado")
                                        <a href="{{ route('budgets.appcancel',[$value->id, 1]) }}" class="btn btn-powercar btn-sm ml-1" data-toggle="tooltip" data-html="true" title="Aprovar Ordem de Serviço">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    @endif
                                @endcan
                                @can('cancel-os')
                                    @if($value->name == "Pendente")
                                    <a href="{{ route('budgets.appcancel',[$value->id, 2]) }}" class="btn btn-danger btn-sm ml-1" data-toggle="tooltip" data-html="true" title="Cancelar Ordem de Serviço">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                    @endif  
                                @endcan
                                @can('show-budget')
                                    <a href="{{ route($routeName.'.show',$value->id) }}" class="btn btn-info btn-sm ml-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('edit-budget')
                                    @if($value->name != "Cancelado" and $value->name != "Pendente")
                                    <a href="{{ route($routeName.'.edit',$value->id) }}" class="btn btn-warning btn-sm ml-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                @endcan
                                @can('delete-budget')
                                    <a href="{{ route($routeName.'.show',[$value->id,'delete=1']) }}" class="btn btn-danger btn-sm ml-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endcan
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalDescriptionBudget" tabindex="-1" role="dialog" aria-labelledby="modalDescriptionBudgetTitle" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header py-2 cor-powercar text-light">
                        <h5 class="modal-title" id="modalDescriptionBudgetTitle">
                            @lang('linguagem.description')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-justify">
                        <span id="descriptionBudget"></span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function budget(description) {
                var desBudget = document.getElementById('descriptionBudget');
                desBudget.innerHTML = description;
            }
        </script>

        <!-- Componente paginate -->
        @paginate_component(['search'=>$search,'list'=>$list])
        @endpaginate_component
        
    @endpage_component
@endsection
