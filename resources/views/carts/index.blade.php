@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
{{--                @include('partials.message', ['message' => $message]) why you no work?--}}
                @include('partials.message')
                <div class="card">
                    <div class="card-header">{{ __('carts.Cart contents') }}</div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modal')
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#exampleModal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            // $(this).find('.modal-body').load(link.attr("href"));
            $.getJSON(link.attr('href'), function (json) {
                // console.log(json.qty);
                // this is the right way to go about getting the promotions,
                //     what needs to happen next is to get the response into a form,
                //     probably with a spinner, and on each increment I should check if the value in the spinner matches
                // the value in json.qty
                // $('.modal-body').html('<h3>' + json.message + ':</h3> ' + json.qty + '<br /><p><input id="spinner" class="" value="0" /></p>');
                var form = '<form method="post" action="{{ route('cart.addpromo') }}">';
                // console.info(json.promo.length);
                // YEY!
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
                        // console.info(event);
                        // console.info(ui); // the max

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