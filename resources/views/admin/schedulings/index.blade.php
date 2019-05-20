@extends('layouts.app')

@section('content')
    @page_component(['col'=>12,'page'=>__('linguagem.list',['page'=>$page])])

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component

        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente search -->
        @search_component(['routeName'=>$routeName,'search'=>$search,'permissionCreate'=>'create-scheduling'])
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
                                <th scope="row">@php echo $value->{$key2} @endphp</th>
                            @elseif($key2 == 'description')
                                <td>
                                    <button class="btn text-secondary" onclick="scheduling('{{ $value->{$key2} }}')" data-toggle="modal" data-target="#modalDescriptionScheduling">
                                        <i class="fas fa-file-alt fa-2x"></i>
                                    </button>
                                </td>
                            @elseif($key2 == 'name')
                                <td>
                                    <i class="fab fa-font-awesome-flag text-@php echo $value->color @endphp"></i> @php echo $value->{$key2} @endphp
                                </td>
                            @else
                                <td>@php echo $value->{$key2} @endphp</td>
                            @endif
                        @endforeach
                        <td class="text-right">
                            
                            @if ($value->name == "Pendente" || $value->name == "Cancelado")
                                @can('approve-scheduling')
                                    <a href="{{ route($routeName.'.approve',$value->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="@lang('linguagem.approve')">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endcan
                            @endif

                            @if ($value->name == "Pendente" || $value->name == "Aprovado")
                                @can('cancel-scheduling')
                                    <a href="{{ route($routeName.'.cancel',$value->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="@lang('linguagem.cancel')">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                @endcan
                            @endif
                            
                            @can('delete-scheduling')
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

        <script>
            function scheduling(description) {
                var desScheduling = document.getElementById('descriptionScheduling');
                desScheduling.innerHTML = description;
            }
        </script>
        
    @endpage_component
@endsection
