@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-{{ $col }}">
            <span>{{ $page }}</span>

            {{ $slot }}
            
        </div>
    </div>
</div>
@endsection
