@extends('layouts.app')

@section('content')

    @page_component(['col'=>12,'page'=>__('linguagem.list',['page'=>$page])])

        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component

        <h4 class="mb-5">Ordem de Serviço Nº: {{ $ordemId }}</h4>

        <!-- Componente form -->
        @form_component(['action'=>route($routeName.'.storeService',$ordemId),'method'=>'POST'])
            @include('admin.'.$routeName.'.formService')
            <button class="btn btn-primary">{{ __('linguagem.add') }}</button>
        @endform_component


        <!-- Componente tabela -->
        <div class="table-responsive-lg mt-5">
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
                    @php
                        $somaTotal = 0;
                    @endphp
                    @foreach ($list as $key => $value)
                    <tr>
                        @foreach ($columnList as $key2 => $value2)
                            @if ($key2 == 'id')
                                <th scope="row">{{ $value->$key2 }}</th>
                            @elseif($key2 == 'vehicle_id')
                                <td>
                                    @if (empty($value->{$key2}))    
                                        <a href="" class="btn btn-success btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Veículo">
                                            <i class="fas fa-car"></i>
                                        </a>
                                    @else
                                        {{ $value->{$key2} }}
                                    @endif
                                </td>
                            @elseif($key2 == 'image')
                                <td>
                                    <img style="max-width: 40px;" class="img-fluid rounded" src="{{$value->$key2}}" alt="perfil">
                                </td>
                            @elseif(($key2 == 'value') || ($key2 == 'total_value'))
                                <td>@php echo "R$ ". number_format($value->{$key2}, 2, ',',' ') @endphp</td>
                            @else
                                <td>@php echo $value->{$key2} @endphp</td>
                            @endif
                        @endforeach
                        <td class="text-right">
                            <a href="{{ route('budgets.deleteService',[$value->budget_id, $value->service_id]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-html="true" title="Deletar produto">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                        @php
                            $somaTotal += $value->value;
                        @endphp
                    @endforeach
                    <tr style="background: #dee2e6;" class="text-powercar">
                        <th colspan="2">Total Serviços:</th>
                        <th>R$ @php echo number_format($somaTotal, 2, ',',' ') @endphp</th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

    @endpage_component

@endsection