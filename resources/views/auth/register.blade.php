@extends('layouts.auth')

@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div id="loginAuth" class="form-row">
            <div class="form-group col-md-5">
                <label for="name" data-toggle="tooltip" data-placement="top" title="@lang('linguagem.name')">
                    <i class="fas fa-id-card-alt"></i>
                </label>
                <input name="name" type="text" class="form-control form-control-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" id="name" placeholder="@lang('linguagem.name')" minlength="4" maxlength="60" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-7">
                <label for="email" data-toggle="tooltip" data-placement="top" title="@lang('linguagem.email')">
                    <i class="fas fa-at"></i>
                </label>
                <input name="email" type="email" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="@lang('linguagem.email')" value="{{ old('email') }}"  minlength="8" maxlength="60" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="password" data-toggle="tooltip" data-placement="top" title="@lang('linguagem.password')">
                    <i class="fas fa-fingerprint"></i>
                </label>
                <input name="password" type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="password" minlength="6" maxlength="16" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="password-confirm" data-toggle="tooltip" data-placement="top" title="@lang('linguagem.confirm_password')">
                    <i class="fas fa-fingerprint"></i>
                </label>
                <input name="password_confirmation" type="password" class="form-control form-control-lg" id="password-confirm" placeholder="@lang('linguagem.confirm_password')" minlength="6" maxlength="16" required>
            </div>
        </div>
        <div class="form-row my-4">
            <div class="form-group col-md-12">
                <button class="btn btn-powercar btn-block btn-lg" type="submit">
                    @lang('linguagem.register')
                </button>
            </div>
        </div>
    </form>
    <span class="text-center my-4 my-md-5 d-block">
        <a class="nav-link" href="{{ route('login') }}">
            @lang('linguagem.login')
        </a>
    </span>

@endsection
