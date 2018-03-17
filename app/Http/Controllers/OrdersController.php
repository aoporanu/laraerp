<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreOrder;
use App\Order;

class OrdersController extends Controller
{
    /**
     * @return $this
     */
    public function create()
    {
        $clients = (new \App\Client)->get(['name', 'tp', 'id']);
        return view('orders.create')->with(['clients' => $clients]);
    }

    /**
     * Daca ajungem aici inseamna ca avem un client si un termen de plata
     * pentru ca nu ne da voie StoreOrder altfel
     * @param StoreOrder $request
     */
    public function store(StoreOrder $request)
    {
        if($request->isXmlHttpRequest())
        {
            $tp = $request->get('tp');
            $client = Client::findOrFail($request->session()->get('client'));
            $order = new Order();
            if($client->tp < $tp)
            {
                $order->tp = $client->tp;
            }
            else
            {
                $order->tp = $tp;
            }
            $order->agemt_id = Auth::user()->id;
            foreach(Cart::content() as $row) {
                $order->products()->save($row);
            }
            $order->status = 'pending';
            $order->save();
            DB::table('invoices')->where('client_id', '=', $client->id)->get(['created', 'due', 'cashed_in', 'last_cashed_in_date']);
        }
    }
}
