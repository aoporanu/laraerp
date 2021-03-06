<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('suppliers', 'SuppliersController@index')->name('suppliers.index');

Route::get('supplier/create', 'SuppliersController@create')->name('suppliers.create');

Route::get('supplier/any', 'SuppliersController@anyData')->name('suppliers.datatable.data');

Route::get('products', 'ProductsController@index')->name('products.index');

Route::get('products/create', 'ProductsController@create')->name('products.create');

Route::post('products/store', 'ProductsController@store')->name('products.store');

Route::get('product/delete/{id}', 'ProductsController@destroy')->name('products.destroy');

Route::get('products/show/{id}', 'ProductsController@show')->name('products.show');

Route::get('product/cart/{id}', 'ProductsController@cart')->name('product.add.to.cart');

Route::get('cart', 'CartsController@index')->name('carts.index');

Route::get('promotions/show/{id}', 'PromotionsController@show')->name('promotions.show');

Route::post('cart/addpromo', 'PromotionsController@addPromo')->name('cart.addpromo');

Route::get('orders/create', 'OrdersController@create')->name('orders.create');

Route::post('orders/store', 'OrdersController@store')->name('orders.store');

Route::get('my-charts', 'ProfileController@stats')->name('dashboard.charts');

Route::get('clients', 'ProfileController@clients')->name('dashboard.clients');

Route::get('debt', 'ProfileController@pastpaid')->name('dashboard.pastpaid');

Route::get('inventory/add-product', 'InventoryController@create')->name('inventory.add.product');

Route::post('cart/add', 'ProductsController@addToCart')->name('add.product.cart');