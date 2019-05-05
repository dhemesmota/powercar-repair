<div class="row">
    <div class="col-md-4">
        <label for="cpf">CPF</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-cpf">
                    <i class="fas fa-id-card"></i>
                </span>
            </div>
            <input type="text" name="cpf" id="cpf" class="cpf form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" value="{{ old('cpf') ?? ($register->cpf ?? '') }}" aria-describedby="basic-cpf" autofocus required>
            @if ($errors->has('cpf'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <label for="telephone">@lang('linguagem.telephone')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-telephone">
                    <i class="fas fa-mobile-alt"></i>
                </span>
            </div>
            <input type="text" name="telephone" id="telephone" class="telephone form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" value="{{ old('telephone') ?? ($register->telephone ?? '') }}" aria-describedby="basic-telephone" required>
            @if ($errors->has('telephone'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('telephone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <label for="zip_code">@lang('linguagem.zip_code')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-zip_code">
                    <i class="fas fa-city"></i>
                </span>
            </div>
            <input type="text" name="zip_code" id="zip_code" class="zip_code form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ old('zip_code') ?? ($register->zip_code ?? '') }}" aria-describedby="basic-zip_code" required>
            @if ($errors->has('zip_code'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <label for="address">@lang('linguagem.address')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-address">
                    <i class="fas fa-map-marked-alt"></i>
                </span>
            </div>
            <input type="text" name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') ?? ($register->address ?? '') }}" aria-describedby="basic-address">
            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
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
            <input type="text" name="neighborhood" id="neighborhood" class="form-control{{ $errors->has('neighborhood') ? ' is-invalid' : '' }}" value="{{ old('neighborhood') ?? ($register->neighborhood ?? '') }}" aria-describedby="basic-neighborhood">
            @if ($errors->has('neighborhood'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('neighborhood') }}</strong>
                </span>
            @endif
        </div>
    </div>
 

</div>