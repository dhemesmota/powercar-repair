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
        
        
    @endpage_component
@endsection
