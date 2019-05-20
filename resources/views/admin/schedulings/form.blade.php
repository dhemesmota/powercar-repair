<div class="row">

    @if (!empty($client))
        <div class="col-md-6">
            <label for="user_id">@lang('linguagem.client')</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-user_id">
                        <i class="fab fa-font-awesome-flag"></i>
                    </span>
                </div>
                <select name="user_id" id="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" value="{{ old('user_id') ?? ($register->user_id ?? '') }}" aria-describedby="basic-user_id" autofocus>
                    <option value="">Selecione um cliente...</option>
                    @foreach ($client as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('user_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
                @endif
            </div>
        </div> 
    @endif

    @if (!empty($situation))
        <div class="col-md-6">
            <label for="situation_id">@lang('linguagem.situation')</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-situation_id">
                        <i class="fab fa-font-awesome-flag"></i>
                    </span>
                </div>
                <select name="situation_id" id="situation_id" class="form-control{{ $errors->has('situation_id') ? ' is-invalid' : '' }}" value="{{ old('situation_id') ?? ($register->situation_id ?? '') }}" aria-describedby="basic-situation_id" required>
                    @foreach ($situation as $item)
                        @if ($item->name == "Aprovado" || $item->name == "Indisponível" || $item->name == "Pendente")
                            
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('situation_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('situation_id') }}</strong>
                    </span>
                @endif
            </div>
        </div> 
    @endif
    
    <div class="col-md-6">
        <label for="date">@lang('linguagem.date')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-date">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="date" name="date" id="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{ old('date') ?? ($register->date ?? '') }}" aria-describedby="basic-date" autofocus required>
            @if ($errors->has('date'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <label for="hour">@lang('linguagem.hour')</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-hour">
                    <i class="far fa-clock"></i>
                </span>
            </div>
            <input type="time" name="hour" id="hour" class="form-control{{ $errors->has('hour') ? ' is-invalid' : '' }}" value="{{ old('hour') ?? ($register->hour ?? '') }}" aria-describedby="basic-hour" required>
            @if ($errors->has('hour'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hour') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group col-12">
        <label for="description">{{ __('linguagem.description') }}</label>
        <textarea name="description" id="description" placeholder="@lang('linguagem.describe_need')" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" maxlength="254" required>{{ old('description') ?? ($register->description ?? '') }}</textarea>

        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div> 

</div>