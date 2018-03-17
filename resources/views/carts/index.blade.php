@extends('layouts.app')

@section('css')
@endsection

@section('content')
        <div class="row justify-content-center">
            <section class="no-padding-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block">

                                {{--                @include('partials.message', ['message' => $message]) why you no work?--}}
                                @include('partials.message')
                                <div class="title">{{ __('carts.Cart contents') }}</div>
                                <div class="block-body">
                                    <table class="table table-bordered table-responsive">
                                        <tr>
                                            <th>{{ __('carts.Product') }}</th>
                                            <th>{{ __('carts.qty') }}</th>
                                            <th>{{ __('carts.price') }}</th>
                                            <th>{{ __('carts.subtotal') }}</th>
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
                                                @foreach($row->model->promotions as $promotion)
                                                    @if($row->qty >= $promotion->mechanism)
                                                        <td>
                                                            <a href="{{ route('promotions.show', ['id' => $row->id]) }}" id="" data-toggle="modal" data-target="#exampleModal" data-content="{{ $row->id }}" class="btn btn-outline-primary {{ $row->id }}">Add promo</a>
                                                        </td>
                                                    @endif
                                                    {{--only show one instance of the button--}}
                                                    @break
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td>{{ __('carts.subtotal') }}</td>
                                                <td><?php echo Cart::subtotal(); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td>{{ __('carts.tax') }}</td>
                                                <td><?php echo Cart::tax(); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td>{{ __('carts.total') }}</td>
                                                <td><?php echo Cart::total(); ?></td>
                                            </tr>

                                            {{-- add link to display modal with promotions if the qty is equal or greater than the promotion qty for the given product --}}
                                            {{-- I have to pass a product, so I can get to $product->promotions()->mechanism --}}
                                        @endforeach

                                    </table>
                                    <a href="{{ route('products.index') }}" class="btn btn-danger">{{ __('carts.continue_shopping') }}</a>
                                    <a href="{{ route('orders.create') }}" class="btn btn-primary">{{ __('orders.next_step') }}</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    @include('partials.modal')
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#exampleModal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            // $(this).find('.modal-body').load(link.attr("href"));
            $.getJSON(link.attr('href'), function (json) {
                var form = '<form method="post" action="{{ route('cart.addpromo') }}">';
                $.each(json.promo, function() {
                    // console.info(this.id);
                    form += '<div class="form-group"><input type="text" class="spinner" value="0" />' +
                        '<label for="spinner">' + this.name + '</label>' +
                        '</div>';
                });
                form += "</form>";
                $('.modal-body').html(form);
                $('.spinner').spinner({
                    'min': 0,
                    'max': json.qty,
                    'spin': function (event, ui) {
                        var curr = ui.value;
                        if(this.value < json.qty) {
                            console.info('Increment');
                            // next of type spinner, set max value as
                            var spinner = $(this).parent().closest($('.spinner'));
                            spinner.spinner({
                                max: json.qty - this.value
                            });
                            console.info(spinner.option('max'));
                        }
                    },
                    'icons': {
                        'up': 'fas fa-arrow-up',
                        'down': 'fas fa-arrow-down'
                    }
                });
            });
        });
    </script>
@endsection