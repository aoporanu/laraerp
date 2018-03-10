<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProduct;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::with('category')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::pluck('id', 'name');
        $categories = Category::pluck('id', 'name');
        return view('products.create', ['suppliers' => $suppliers, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProduct $request
     * @return void
     */
    public function store(StoreProduct $request)
    {
//        dd($request->all());
        $category = Category::findOrFail($request->get('category_id'));
        $supplier = Supplier::find($request->get('supplier_id'));

        $product = new Product;

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->sku = 10100008;
        $category->product()->save($product);

        return redirect()->route('products.index')->with('message', 'The product has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
