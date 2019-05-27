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
        @search_component(['routeName'=>$routeName,'search'=>$search,'permissionCreate'=>'create-situation'])
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
                            @elseif($key2 == 'vehicle_id')
                                <td>
                                    @if (empty($value->{$key2}))    
                                        <a href="{{ route($routeName.'.vehicle',[$value->id,$value->client_id]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Veículo">
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
                            @elseif($key2 == 'value')
                                <td>@php echo "R$ ".$value->{$key2} @endphp</td>
                            @else
                                <td>@php echo $value->{$key2} @endphp</td>
                            @endif
                        @endforeach
                        <td class="text-right">
                            <a href="{{ route($routeName.'.product',$value->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Produtos">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                            <a href="{{ route($routeName.'.service',$value->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-html="true" title="Adicionar Serviços">
                                <i class="fas fa-tools"></i>
                            </a>
                            @can('show-situation')
                                <a href="{{ route($routeName.'.show',$value->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can('edit-situation')
                                <a href="{{ route($routeName.'.edit',$value->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('delete-situation')
                                <a href="{{ route($routeName.'.show',[$value->id,'delete=1']) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Componente paginate -->
        @paginate_component(['search'=>$search,'list'=>$list])
        @endpaginate_component
        
    @endpage_component
@endsection
