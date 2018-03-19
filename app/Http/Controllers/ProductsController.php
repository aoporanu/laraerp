<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\StoreProduct;
use App\Product;
use App\Supplier;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::with(['category', 'inventory'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $suppliers = (new Supplier)->pluck('id', 'name');
        /** @noinspection PhpUndefinedMethodInspection */
        $categories = (new Category)->pluck('id', 'name');
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
        $category = new Category();
        /** @noinspection PhpUndefinedMethodInspection */
        $category->findOrFail($request->get('category_id'));
        /** @noinspection PhpUndefinedMethodInspection */
        $supplier = (new Supplier)->find($request->get('supplier_id'));

        $product = new Product;

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->sku = 10100008;
        $category->product()->save($product);
        /** @noinspection PhpUndefinedMethodInspection */
        $supplier->products()->save($product);

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
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        return redirect()->route('products.index')->with('message', 'The product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('message', $e->getMessage());
        }

        return redirect()->route('products.index')->with('message', 'The product has been deleted');
    }

    /**
     * Should only display the modal with the product.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function cart($id)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $product = Product::findOrFail($id);
        /** @noinspection PhpUndefinedFieldInspection */

        // mark the quantity of products in inventory table as on-hold
        return view('carts.partials.add')->with('product', $product);
    }

    /**
     * @param AddToCartRequest $request
     */
    public function addToCart(AddToCartRequest $request)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $product = Product::findOrFail($request->get('id'));
        /** @noinspection PhpUndefinedFieldInspection */
        /** @noinspection PhpUndefinedFieldInspection */
        /** @noinspection PhpUndefinedMethodInspection  */
        Cart::add($product->id, $product->name, $request->get('qty'), $product->price)->associate(Product::class);
        $qty = $product->qty - $request->get('qty');
        // taking care of the product quantity
        $product->qty = $qty;
        /** @noinspection PhpUndefinedMethodInspection */
        $product->save();
    }
}
