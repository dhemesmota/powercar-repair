<div class="row">
    <div class="form-group col-md-6">
        <label for="model">{{ __('linguagem.model') }}</label>
        <input type="text" name="model" id="model" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}"  value="{{ old('model') ?? ($register->model ?? '') }}" required autofocus>

        @if ($errors->has('model'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('model') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="year">{{ __('linguagem.year') }}</label>
        <input type="text" name="year" id="year" class="year form-control{{ $errors->has('year') ? ' is-invalid' : '' }}"  value="{{ old('year') ?? ($register->year ?? '') }}" required>

        @if ($errors->has('year'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('year') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="board">{{ __('linguagem.board') }}</label>
        <input type="text" name="board" id="board" class="board form-control{{ $errors->has('board') ? ' is-invalid' : '' }}"  value="{{ old('board') ?? ($register->board ?? '') }}" required>

        @if ($errors->has('board'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('board') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="color">{{ __('linguagem.color') }}</label>
        <select name="color" id="color" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" required>
            <option value="">...</option>
            <option value="Branco">Branco</option>
            <option value="Preto">Preto</option>
            <option value="Prata">Prata</option>
            <option value="Azul">Azul</option>
            <option value="Vermelho">Vermelho</option>
            <option value="Verde">Verde</option>
            <option value="Outra">Outra</option>
        </select>

        @if ($errors->has('color'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('color') }}</strong>
            </span>
        @endif
    </div>
</div>