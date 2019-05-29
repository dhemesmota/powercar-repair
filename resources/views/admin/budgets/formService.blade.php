<div class="row">
    
    @if (!empty($services))
        <div class="form-group col-md-6">
            <label for="service_id">{{ __('linguagem.service') }}</label>
            <select type="text" name="service_id" id="service_id" class="form-control{{ $errors->has('service_id') ? ' is-invalid' : '' }}" required >
                <option value="">Selecione um serviço...</option>
                @foreach ($services as $key => $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>

            @if ($errors->has('product_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('product_id') }}</strong>
                </span>
            @endif
        </div>
    @endif


</div>