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
                                    @foreach($row->model->promotions as $promotion)
                                        @if($row->qty >= $promotion->mechanism)
                                            <td>
                                                <a href="{{ route('promotions.show', ['id' => $row->id]) }}" id="" data-toggle="modal" data-target="#exampleModal" data-content="{{ $row->id }}" class="btn btn-outline-primary {{ $row->id }}">Add promo</a>
                                            </td>
                                        @endif
                                    @endforeach
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
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add promo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label  class="col-sm-2 control-label"
                                    for="inputEmail3">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control"
                                       id="inputEmail3" placeholder="Email"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="inputPassword3" >Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control"
                                       id="inputPassword3" placeholder="Password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"/> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $("#exampleModal").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                $(this).find('.modal-body').load(link.attr("href"));
        });
    </script>
@endsection