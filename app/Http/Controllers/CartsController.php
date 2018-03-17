<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $agent = new Role();
//        $agent->name = 'agent';
//        $agent->display_name = 'Agent';
//        $agent->description = 'Add new orders, pick orders from clients';
//        $agent->save();

//        $agent = Role::where('name', '=', 'agent')->first();
//
////        $user = User::where('id', '=', 1)->first();
//
////        $user->roles()->attach($agent->id);
//        $createOrder = Permission::where('id', '=', 1)->first();
//        $agent->attachPermission($createOrder);
        return view('carts.index');
    }
}
