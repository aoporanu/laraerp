<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Promotion;
use App\User;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * Merge pentru un singur produs in parte, ar trebui facuta sa mearga
     * pentru tot cartul de cumparaturi
     * @param $id
     * @return array
     */
    public function show($id, Request $request)
    {
        $promotion = Promotion::findOrFail($id);

        $qty = 0;
        $response = [];
        foreach(Cart::content() as $row) {
            // round it down to mechanism
            /** @var CartItem $row */
            $qty = (int)$row->qty / $promotion->mechanism;
        }
        $qty = intval($qty);
        $response['qty'] = $qty;
        // check if product doesn't already have a promo price on it
        foreach(Cart::content() as $row) {
            if($row->model->promo_price != '') {
//                TODO return response that the given product already has a promo price on it
                $response['message'] = __('promotions.promo_price_for_product');
            } elseif($row->model->promo_price == '') {
//                return the promotions array
                $promo = Inventory::where([['type', '=', 'free'], ['for', '=', $promotion->name]])->get();
                $response['message'] = __('promotions.available_promotions');
                $response['promo'] = $promo;
            }
        }
        return response()->json($response);
    }

    public function addPromo(Request $request)
    {
        if(Auth::user()->hasRole('agent')) {
            dd(Cart::content());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
