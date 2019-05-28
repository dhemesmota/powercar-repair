<div class="row">
    
    @if (!empty($products))
        <div class="form-group col-md-6">
            <label for="product_id">{{ __('linguagem.product') }}</label>
            <select type="text" name="product_id" id="product_id" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required >
                <option value="">Selecione um produto...</option>
                @foreach ($products as $key => $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>

            @if ($errors->has('product_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('product_id') }}</strong>
                </span>
            @endif
        </div>
    @endif

    <div class="col-md-6">
        <label for="amount">@lang('linguagem.amount')</label>
        <div class="input-group mb-3">
            <input type="text" name="amount" id="amount" class="amount form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount') ?? ($register->amount ?? '') }}" aria-describedby="basic-amount" required>
            @if ($errors->has('amount'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('amount') }}</strong>
                </span>
            @endif
        </div>
    </div>


</div>