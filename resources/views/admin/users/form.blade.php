<div class="row">
    <div class="col-md-6">
        <label for="name">@lang('linguagem.name')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-name">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') ?? ($register->name ?? '') }}" aria-describedby="basic-name" autofocus required>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <label for="email">@lang('linguagem.email')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-email">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
            <input type="mail" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') ?? ($register->email ?? '') }}" aria-describedby="basic-email" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <label for="password">@lang('linguagem.password')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-password">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="basic-password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <label for="password_confirmation">@lang('linguagem.confirm_password')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-password_confirmation">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" aria-describedby="basic-password_confirmation" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="image">@lang('linguagem.image')</span>
            </div>
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="inputImage" aria-describedby="image">
                <label class="custom-file-control custom-file-label" id="labelImage" for="inputImage">Selecione uma imagem...</label>
            </div>
        </div>
    </div>

    <div class="form-group col-6">
        <label for="roles">{{ __('linguagem.role_list') }}</label>
        <div class="form-group">
            @foreach ($roles as $key => $value)

                @php
                    $checked = '';
                    // No caso da validação, permitir que fique selecionado as permissões selecionadas
                    if(old('roles') ?? false){
                        foreach (old('roles') as $key => $id) {
                            if($id == $value->id){
                                $checked = 'checked';
                            }
                        }
                    } else {
                        if($register ?? false){
                            foreach ($register->roles as $key => $role) {
                                if($role->id == $value->id){
                                    $checked = 'checked';
                                }
                            }
                        }
                    }
                @endphp

                <div class="form-check">
                    <input {{ $checked }} type="checkbox" class="form-check-input" name="roles[]" id="{{ $value->id }}" value="{{ $value->id }}">
                    <label class="form-control-label" for="{{ $value->id }}">{{ $value->name }}</label>
                </div>
            @endforeach
        </div>
    </div>

</div>