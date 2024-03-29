@extends('layouts.app')

@section('content')
    @page_component(['col'=>12,'page'=>__('linguagem.show_crud',['page'=>$page2])])
    
        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component
        
        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        @if ($delete)
            <!-- Componente form -->
            @form_component(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
                <button class="btn btn-danger btn-lg">{{ __('linguagem.delete') }}</button>
            @endform_component
        @endif
        
        
    @endpage_component
@endsection
