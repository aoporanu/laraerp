@extends('layouts.app')

@section('content')
{{--    {{ dump(gettype($suppliers)) }}--}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Product</div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" class="form-horizontal" method="post">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="form-group row">
                                <label for="name" class="col-form-label">Product name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid': '' }}" id="name" name="name" value="{{ old('name') }}" />
                                @if($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option value="">{{ __('Please select category') }}</option>
                                    @foreach($categories as $key => $val)
                                        <option value="{{ $val }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control">
                                    <option value="">{{ __('Please select supplier') }}</option>
                                    @foreach($suppliers as $key => $val)
                                        <option value="{{ $val }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('supplier_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('supplier_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" id="price" class="form-control" name="price" />
                                @if($errors->has('price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="weight" class="form-label">{{ __('Weight') }}</label>
                                <input type="text" id="weight" class="form-control" name="weight" />
                                @if($errors->has('weight'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="packaging" class="control-label">{{ __('Packaging') }}</label>
                                <input type="text" name="packaging" class="form-control" id="packaging" />
                                @if($errors->has('packaging'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('packaging') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary">{{ __('Create Product') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection