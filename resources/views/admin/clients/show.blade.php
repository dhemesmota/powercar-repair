@extends('layouts.app')

@section('content')
    @page_component(['col'=>12,'page'=>__('linguagem.show_crud',['page'=>$page2])])
    
        <!-- Componente mensagens de alerta -->
        @alert_component(['msg'=>session('msg'),'status'=>session('status')])
        @endalert_component

        <!-- Componente breadcrumb -->
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component


        <div class="row">
            <div class="col-md-3 text-center">
                <div class="card bg-light mb-3 shadow">
                    <img class="img-fluid" src="{{ $register->image }}" alt="{{ $register->name }}">
                </div>
                <p>{{ __('linguagem.name') }}: {{ $register->name }}</p>
                <p>{{ __('linguagem.email') }}: {{ $register->email }}</p>
            </div>
            <div class="col-md-9">
                <h5 class="font-slim">@lang('linguagem.personal_data')</h5>
                @if (isset($profile) and !empty($profile))
                    @foreach ($profile as $key => $item)
                        <div id="perfilDados" class="row">
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <label for="cpf">CPF</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-cpf">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="cpf" class="cpf form-control" value="{{ $item->cpf }}" aria-describedby="basic-cpf" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <label for="telephone">@lang('linguagem.telephone')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-telephone">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="telephone" class="telephone form-control" value="{{ $item->telephone }}" aria-describedby="basic-telephone" disabled>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <label for="zip_code">@lang('linguagem.zip_code')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-zip_code">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="zip_code" class="zip_code form-control" value="{{ $item->zip_code }}" aria-describedby="basic-zip_code" disabled>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <label for="address">@lang('linguagem.address')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-address">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="address" class="form-control" value="{{ $item->address }}" aria-describedby="basic-address" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="neighborhood">@lang('linguagem.neighborhood')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-neighborhood">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="neighborhood" class="form-control" value="{{ $item->neighborhood }}" aria-describedby="basic-neighborhood" disabled>
                                </div>
                            </div>
                        </div>
                        

                        <!--
                        <div class="d-flex justify-content-center align-items-center bg-light rounded">
                            <a href="{{ route('profile.edit',$item->id) }}" class="btn btn-warning my-4">
                                @lang('linguagem.edit')
                            </a>
                        </div>
                        -->
                    @endforeach
                @elseif(empty($profile))
                    
                <!--
                    <div class="d-flex justify-content-center align-items-center bg-light rounded">
                        <a href="{{ route('profile.create') }}" class="btn btn-warning my-5">
                            @lang('linguagem.add')
                        </a>
                    </div>
                -->
                @endif
            </div>
        </div>

        @if ($delete)
            <!-- Componente form -->
            @form_component(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">{{ __('linguagem.delete') }}</button>
            @endform_component
        @endif
        
        
    @endpage_component
@endsection
