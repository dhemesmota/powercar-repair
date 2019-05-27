@extends('layouts.app')

@section('content')
    @page_component(['col'=>12,'page'=>__('linguagem.create_crud',['page'=>$page_create])])
    
        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component

        <!-- Componente form -->
        @form_component(['action'=>route($routeName.'.storeVehicle',$ordemId),'method'=>'PUT'])
            @include('admin.'.$routeName.'.formVehicle')
            <button class="btn btn-primary btn-lg float-right">{{ __('linguagem.add') }}</button>
        @endform_component
        
    @endpage_component
@endsection
