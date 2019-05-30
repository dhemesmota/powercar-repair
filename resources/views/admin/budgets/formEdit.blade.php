<div class="row">
    <div class="form-group col-md-6">
        <label for="situation_id">{{ __('linguagem.situation') }}</label>
        <select type="text" name="situation_id" id="situation_id" class="form-control{{ $errors->has('situation_id') ? ' is-invalid' : '' }}" required >
            <option value="">Selecione uma situação...</option>
            @foreach ($situations as $key => $situation)
                <option value="{{ $situation->id }}">{{ $situation->name }}</option>
            @endforeach
        </select>

        @if ($errors->has('situation_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('situation_id') }}</strong>
            </span>
        @endif
    </div>
</div>