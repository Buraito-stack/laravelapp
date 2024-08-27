<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();

        return response()->json(['products' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
        [
            'name'  => ['required',  'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ], 
            [
                "name.required"  => "name is invalid",
                "name.max"       => "name is limits",
                "stock.required" => "stock is invalid",
                "stock.integer"  => "stock wasn't number",
                "stock.min"      => "stock must be more than 0",
                "price.required" => "price is invalid",
                "price.integer"  => "price wasn't number",
                "price.min"      => "price must be more than 0",
            ]
        );

        $product = new Product($validate);

        $product->save();

        return response()->json(['product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate(
        [
            'name'  => ['required',  'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ], 
            [
                "name.required"  => "name is invalid",
                "name.max"       => "name is limits",
                "stock.required" => "stock is invalid",
                "stock.integer"  => "stock wasn't number",
                "stock.min"      => "stock must be more than 0",
                "price.required" => "price is invalid",
                "price.integer"  => "price wasn't number",
                "price.min"      => "price must be more than 0",
            ]
        );

        $product = Product::findOrFail($id);

        $product->update($validate);

        return response()->json(['product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json(['product' => $product]);
    }
}