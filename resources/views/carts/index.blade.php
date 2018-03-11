@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cart contents</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            @foreach(Cart::content() as $row)
                                <tr>
                                    <td>
                                        <p><strong><?php echo $row->name; ?></strong></p>
                                        <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
                                    </td>
                                    <td><input type="text" value="<?php echo $row->qty; ?>"></td>
                                    <td>$<?php echo $row->price; ?></td>
                                    <td>$<?php echo $row->total; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Subtotal</td>
                                    <td><?php echo Cart::subtotal(); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Tax</td>
                                    <td><?php echo Cart::tax(); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Total</td>
                                    <td><?php echo Cart::total(); ?></td>
                                </tr>
                            {{-- add link to display modal with promotions if the qty is equal or greater than the promotion qty for the given product --}}
                            {{-- I have to pass a product, so I can get to $product->promotions()->mechanism --}}
                                @if($row->qty >= $row->product->promotions()->mechanism)
                                    <tr>
                                        <td colspam="4">
                                            <a href="#" id="add_promo_for_{{ $row->id }}">Add Promotion</a>
                                        </td>
                                    </tr>
                                @endif
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