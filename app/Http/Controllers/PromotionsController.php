<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Promotion;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionsController extends Controller
{
    /**
     * Display the specified resource.
     * Merge pentru un singur produs in parte, ar trebui facuta sa mearga
     * pentru tot cartul de cumparaturi
     * @param $id
     * @param Request $request
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
                $response['message'] = __('promotions.promo_price_for_product');
            } elseif($row->model->promo_price == '') {
//                return the promotions array
                /** @noinspection PhpDynamicAsStaticMethodCallInspection */
                $promo = Inventory::where([['type', '=', 'free'], ['for', '=', $promotion->name]])->get();
                $response['message'] = __('promotions.available_promotions');
                $response['promo'] = $promo;
            }
        }
        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPromo(Request $request)
    {
        $rowId = $request->get('id');
        /* @FIXED CartItemOptions gets added as empty array */
        DB::enableQueryLog();
        foreach($request->get('promo') as $p) {
            $promo = Inventory::where([['type', '=', 'free'], ['name', '=', $p['name']['value']]])->first();
            Cart::update($rowId, ['options' => ['promo' => $p['name']['value'], 'qty' => $p['name']['cutie'], 'price' => 0.0]]);
            /* @TODO subtract cutie amt from qty field of inventory. */
        }
        return redirect()->route('carts.index')->with('message', 'Your promotions have been set');
    }
}
