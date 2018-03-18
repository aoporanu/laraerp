@extends('layouts.app')

@section('css')
@endsection

@section('content')
    {{--{{ dd(Cart::content()) }}--}}
        <div class="row justify-content-center">
            <section class="padding-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block margin-bottom-sm">
                                @include('partials.message')
                                <div class="title">{{ __('carts.Cart contents') }}</div>
                                <div class="block-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
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
                                                                <a href="{{ route('promotions.show', ['id' => $row->id]) }}" id="{{ $row->rowId }}" data-toggle="modal" data-target="#exampleModal" data-content="{{ $row->id }}" class="btn btn-outline-primary {{ $row->id }}">Add promo</a>
                                                            </td>
                                                        @endif
                                                        {{--only show one instance of the button--}}
                                                        @break
                                                    @endforeach
                                                </tr>

                                            @endforeach
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
                                        </table>
                                    </div>

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
            let link = $(e.relatedTarget);
            // console.info();
            let id = $(e.relatedTarget).attr('id');
            $.getJSON(link.attr('href'), function (json) {
                console.info(json);
                let form = '<form method="post" action="{{ route('cart.addpromo') }}">';
                let i = 0;
                form += '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';
                form += '<input type="hidden" name="id" value="'+ id +'" />';
                form += '<input type="hidden" name="qty" id="qty" value="' + json.qty + '" />';
                $.each(json.promo, function() {
                    i++;
                    // console.info(this.id);
                    // language=HTML
                    form += '<div class="form-group">' +
                        '<input type="text" class="spinner" name="promo[' + i + '][name][qty]" value="0" />' +
                        '<input type="hidden" name="promo[' + i + '][name]" value="' + this.name + '" />' +
                        '<label class="control-label" for="spinner">' + this.name + '</label>' +
                        '</div>';
                });
                form += '<div class="form-group"><button class="btn btn-primary" type="submit">{{ __("carts.Add promo") }}</button></div>';
                form += "</form>";
                let spinners = $('.spinner');
                spinners.each(function() {
                    let max = document.getElementById('qty');
                    let value = Number($(this).text(), 10),
                        availableTotal = max;
                    $(this).empty().slider({
                        value: 0,
                        min: 0,
                        max: max,
                        range: "max",
                        step: 1,
                        animate: 100,
                        disabled: (function(curMax) {
                            if(curMax < 1) {
                                return 1;
                            }
                            return 0;
                        })($(this).siblings().attr('max')),
                        stop: function(event, ui) {
                            $(this).siblings().attr('value', ui.value);
                            $(this).siblings().trigger('change');
                        }
                    });
                });
                $('.modal-body').html(form);
            });
        });
    </script>
@endsection