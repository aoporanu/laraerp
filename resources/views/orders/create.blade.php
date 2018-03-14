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
                        <form action="{{ route('orders.store') }}" method="post" class="form form-horizontal">
                            <div class="form-row">
                                <label class="control-label" for="client">{{ __('orders.select_client') }}</label>
                                <select name="client" id="client">
                                    <option value="">{{__('orders.select_client')}}</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row">
                                <label for="tp" class="control-label">{{ __('orders.tp') }}</label>
                                <input value="{{ $client->tp }}" id="tp" name="tp" class="form-control" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('scripts')
    @endsection