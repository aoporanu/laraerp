@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products index</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        <a href="{{ route('inventory.add.product', ['id' => $product->id]) }}">{{ __('products.add_to_inventory') }}</a>
                                        {{-- Only agents and operators can see this link --}}
                                        @if(Auth::user() && (Auth::user()->hasRole('agent') || Auth::user()->hasRole('operator')))
                                            <a href="{{ route('product.add.to.cart', ['id' => $product->id]) }}">{{ __('products.add_to_cart') }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection