<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::query()  
            ->when($request->filled('keyword'), 
                fn($query) => $query->where('name', 'like', "%{$keyword}%")
            )
            ->paginate(10);
    
        return view('products.index', compact('products'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'  => ['required', 'string', 'max:100'],
                'price' => ['required', 'numeric', 'min:0'],
                'stock' => ['required', 'integer', 'min:0'],
            ], 
            [
                'name.required'  => 'Name is invalid',
                'name.max'       => 'Name exceeds limit',
                'stock.required' => 'Stock is invalid',
                'stock.integer'  => 'Stock must be a number',
                'stock.min'      => 'Stock must be more than 0',
                'price.required' => 'Price is invalid',
                'price.numeric'  => 'Price must be a number',
                'price.min'      => 'Price must be more than 0',
            ]
        );

        $product = Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate(
            [
                'name'  => ['required', 'string', 'max:100'],
                'price' => ['required', 'numeric', 'min:0'],
                'stock' => ['required', 'integer', 'min:0'],
            ], 
            [
                'name.required'  => 'Name is invalid',
                'name.max'       => 'Name exceeds limit',
                'stock.required' => 'Stock is invalid',
                'stock.integer'  => 'Stock must be a number',
                'stock.min'      => 'Stock must be more than 0',
                'price.required' => 'Price is invalid',
                'price.numeric'  => 'Price must be a number',
                'price.min'      => 'Price must be more than 0',
            ]
        );

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
