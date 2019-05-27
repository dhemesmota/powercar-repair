<div class="row">
    <div class="form-group col-md-6">
        <label for="vehicle_id">{{ __('linguagem.vehicle') }}</label>
        <select type="text" name="vehicle_id" id="vehicle_id" class="form-control{{ $errors->has('vehicle_id') ? ' is-invalid' : '' }}" required >
            <option value="">Selecione um veículo...</option>
            @foreach ($vehicles as $key => $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->model }}</option>
            @endforeach
        </select>

        @if ($errors->has('vehicle_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('vehicle_id') }}</strong>
            </span>
        @endif
    </div>
</div>