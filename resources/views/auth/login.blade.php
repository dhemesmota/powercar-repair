@extends('layouts.auth')

@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div id="loginAuth" class="form-row">
            <div class="form-group col-md-6">
                <label style="cursor:pointer;" for="email" data-toggle="tooltip" data-placement="top" title="@lang('linguagem.email')">
                    <i class="far fa-user"></i>
                </label>
                <input name="email" type="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                    placeholder="@lang('linguagem.email')" value="{{ old('email') }}" minlength="6" maxlength="60" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label style="cursor:pointer;" for="password" data-toggle="tooltip" data-placement="top" title="@lang('linguagem.password')">
                    <i class="fas fa-fingerprint"></i>
                </label>
                <input name="password" type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                    placeholder="@lang('linguagem.password')" minlength="6" maxlength="16" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-row my-4">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-powercar btn-block btn-lg">
                    @lang('linguagem.login')
                </button>
            </div>
        </div>
    </form>
    @if (Route::has('password.request'))
        <span class="text-center">
            <a class="nav-link text-secondary" href="{{ route('password.request') }}">
                @lang('linguagem.forgot_your_password')
            </a>
        </span>
    @endif
    <span class="text-center mt-4 mt-md-4 d-block">
        <a class="nav-link" href="{{ route('register') }}">
            @lang('linguagem.register')
        </a>
    </span>

@endsection
