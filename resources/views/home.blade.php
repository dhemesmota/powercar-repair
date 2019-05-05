@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-3 text-secondary font-slim">
                <i class="fas fa-tachometer-alt"></i> @lang('linguagem.dashboard')
            </div>
            <hr class="linha">

            @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
            @endalert_component

            @foreach ($roleUsuario as $key => $item)
                @if (($item->id == 5) or ($item->name == "Cliente"))
                    @cliente_component
                    @endcliente_component
                @elseif(($item->id == 4) or ($item->name == "Funcionario"))
                    @funcionario_component
                    @endfuncionario_component
                @elseif(($item->id == 3) or ($item->name == "Gerente"))
                    @gerente_component
                    @endgerente_component
                @elseif(($item->id == 2) or ($item->name == "Gerente Master"))
                    @gerente_master_component
                    @endgerente_master_component
                @elseif(($item->id == 1) or ($item->name == "Administrador"))
                    @admin_component
                    @endadmin_component
                @else
                    <h1>Bem vindo!</h1>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
