@extends('layouts.app')

@section('content')

    @page_component(['col'=>12,'page'=>__('linguagem.list',['page'=>$page])])

        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component

        <!-- Componente form -->
        @form_component(['action'=>route($routeName.'.storeProduct',$ordemId),'method'=>'POST'])
            @include('admin.'.$routeName.'.formProduct')
            <button class="btn btn-primary btn-lg">{{ __('linguagem.add') }}</button>
        @endform_component

    @endpage_component

@endsection