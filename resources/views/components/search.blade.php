<form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
        @can($permissionCreate)
            <div class="form-group mb-2 mr-3">
                <a class="nav-link text-success" href="{{ route($routeName.'.create') }}">
                    <i class="fas fa-plus-circle"></i> {{ __('linguagem.add') }}
                </a>
            </div>
        @endcan
    <div class="form-group mr-sm-3 mb-2">
        <input type="search" name="search" class="form-control form-control-sm" placeholder="{{ __('linguagem.search') }}" value="{{$search}}">
    </div>
    <button type="submit" class="btn btn-primary mb-2 btn-sm"><i class="fas fa-search"></i> {{ __('linguagem.search') }}</button>
    <a href="{{ route($routeName.'.index') }}" class="btn btn-secondary mb-2 ml-2 btn-sm"><i class="fas fa-eraser"></i> {{ __('linguagem.clean') }}</a>
</form>