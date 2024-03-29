<div class="row">
    <div class="form-group col-6">
        <label for="name">{{ __('linguagem.name') }}</label>
        <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{ old('name') ?? ($register->name ?? '') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-4">
        <label for="value">{{ __('linguagem.value') }}</label>
        <input type="text" name="value" id="value" class="value form-control{{ $errors->has('value') ? ' is-invalid' : '' }}"  value="{{ old('value') ?? ($register->value ?? '') }}" required>

        @if ($errors->has('value'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('value') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-2">
        <label for="stock">{{ __('linguagem.stock') }}</label>
        <select name="stock" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" required>
            <option value="">...</option>
            <option value="s">Sim</option>
            <option value="n">Não</option>
        </select>

        @if ($errors->has('stock'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('stock') }}</strong>
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