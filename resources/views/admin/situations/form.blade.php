<div class="row">
    <div class="form-group col-md-6">
        <label for="name">{{ __('linguagem.name') }}</label>
        <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{ old('name') ?? ($register->name ?? '') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="color">{{ __('linguagem.color') }}</label>
        <select name="color" id="color" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" required>
            <option value="primary" class="text-primary">Azul</option>
            <option value="success" class="text-success">Verde</option>
            <option value="warning" class="text-warning">Amarelo</option>
            <option value="danger" class="text-danger">Vermelho</option>
            <option value="info" class="text-info">Azul Claro</option>
            <option value="light" class="text-light">Claro</option>
            <option value="secondary" class="text-secondary">Cinza</option>
            <option value="dark" class="text-dark">Preto</option>
        </select>

        @if ($errors->has('color'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('color') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-12">
        <label for="description">{{ __('linguagem.description') }}</label>
        <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{ old('description') ?? ($register->description ?? '') }}</textarea>

        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>