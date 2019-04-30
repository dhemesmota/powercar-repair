@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-{{ $col }}">
            <div class="card">
                <div class="bg-powercar rounded-top p-4 text-light">{{ $page }}</div>

                <div class="card-body p-4">

                    {{ $slot }}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
