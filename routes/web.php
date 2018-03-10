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
