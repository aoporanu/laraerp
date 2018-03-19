<form class="form form-horizontal" method="post" action="{{ route('add.product.cart') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" id="id" name="id" value="{{ $product->id }}" />
    <div class="form-row">
        <label for="name" class="control-label">{{ __('carts.product_name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" readonly />
    </div>
    <div class="form-row">
        <label for="qty" class="control-label">{{ __('carts.qty') }}</label>
        <input type="text" class="form-control" id="qty" name="qty">
    </div>
    <div class="form-row">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">{{ __('carts.submit') }}</button>
        </div>
    </div>
</form>