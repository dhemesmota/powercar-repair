<div class="row">
    <div class="form-group col-md-6">
        <label for="client_id">{{ __('linguagem.client') }}</label>
        <select type="text" name="client_id" id="client_id" class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" required >
            <option value="">Selecione um cliente...</option>
            @foreach ($clients as $key => $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>

        @if ($errors->has('client_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('client_id') }}</strong>
            </span>
        @endif
    </div>

    @if (!empty($employees))
        <div class="form-group col-md-6">
            <label for="employee_id">{{ __('linguagem.employee') }}</label>
            <select type="text" name="employee_id" id="employee_id" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" required >
                <option value="">Selecione um funcionário...</option>
                @foreach ($employees as $key => $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>

            @if ($errors->has('employee_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('employee_id') }}</strong>
                </span>
            @endif
        </div>
    @endif

    
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