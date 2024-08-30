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
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ], [
            "name.required"  => "Name is invalid",
            "name.max"       => "Name exceeds limit",
            "stock.required" => "Stock is invalid",
            "stock.integer"  => "Stock must be a number",
            "stock.min"      => "Stock must be more than 0",
            "price.required" => "Price is invalid",
            "price.numeric"  => "Price must be a number",
            "price.min"      => "Price must be more than 0",
        ]);

        $product = Product::create($validate);

        return response()->json(['product' => $product], 201);
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
        $validate = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ], [
            "name.required"  => "Name is invalid",
            "name.max"       => "Name exceeds limit",
            "stock.required" => "Stock is invalid",
            "stock.integer"  => "Stock must be a number",
            "stock.min"      => "Stock must be more than 0",
            "price.required" => "Price is invalid",
            "price.numeric"  => "Price must be a number",
            "price.min"      => "Price must be more than 0",
        ]);

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

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
