@extends('layouts.app')

@section('content')
    @page_component(['col'=>12,'page'=>__('linguagem.show_crud',['page'=>$page2])])
    
        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component

        <p><strong>{{ __('linguagem.budget') }}</strong>: {{ $register->id }}</p>
        <p><strong>{{ __('linguagem.total_price') }}</strong>: R$ {{ $register->total_price }}</p>
        @if (!auth()->user()->isClient())
            <p><strong>{{ __('linguagem.client') }}</strong>: {{ $register->client }}</p>
        @endif
        <p><strong>{{ __('linguagem.vehicle') }}</strong>: {{ $register->model }}</p>
        <p><strong>{{ __('linguagem.employee') }}</strong>: {{ $register->employee }}</p>
        <p><strong>{{ __('linguagem.description') }}</strong>: {{ $register->description }}</p>

        @if ($delete)
            <!-- Componente form -->
            @form_component(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">{{ __('linguagem.delete') }}</button>
            @endform_component
        @endif


        <!-- Componente tabela Produtos -->
        @if(!empty($products[0]))
            <div class="table-responsive-lg mt-5">
                <h4>Lista de produtos</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            @foreach ($columnListProducts as $key => $value)
                                <th scope="col">{{ $value }}</th>      
                            @endforeach
                            <th scope="col" class="text-right">{{ __('linguagem.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $somaTotal = 0;
                        @endphp
                        @foreach ($products as $key => $value)
                        <tr>
                            @foreach ($columnListProducts as $key2 => $value2)
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
                                @if(!auth()->user()->isClient())
                                    <a href="{{ route('budgets.deleteProduct',[$value->budget_id, $value->product_id]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-html="true" title="Deletar produto">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                            @php
                                $somaTotal += $value->total_value;
                            @endphp
                        @endforeach
                        <tr style="background: #dee2e6;" class="text-powercar">
                            <th colspan="3">Total Produtos:</th>
                            <th>R$ @php echo number_format($somaTotal, 2, ',',' ') @endphp</th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Componente tabela Serviços -->
        @if(!empty($services[0]))
        <div class="table-responsive-lg mt-5">
            <h4>Lista de serviços</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            @foreach ($columnListServices as $key => $value)
                                <th scope="col">{{ $value }}</th>      
                            @endforeach
                            <th scope="col" class="text-right">{{ __('linguagem.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $somaTotal = 0;
                        @endphp
                        @foreach ($services as $key => $value)
                        <tr>
                            @foreach ($columnListServices as $key2 => $value2)
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
                                @if(!auth()->user()->isClient())
                                    <a href="{{ route('budgets.deleteService',[$value->budget_id, $value->service_id]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-html="true" title="Deletar produto">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
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
        @endif
        
        
    @endpage_component
@endsection
