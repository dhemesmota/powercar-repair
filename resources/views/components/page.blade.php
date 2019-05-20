@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-{{ $col }} mb-5">
            <span class="mb-5">{{ $page }}</span>

            {{ $slot }}
            
        </div>
    </div>
</div>
@endsection
