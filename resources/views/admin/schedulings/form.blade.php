<div class="row">
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

    @if (!empty($situation))
        tem dados
    @endif

</div>