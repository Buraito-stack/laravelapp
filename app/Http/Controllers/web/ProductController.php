<?php

namespace App\Http\Controllers\web;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all(); 
    
        return view('products.index', ['products' => $products]);
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
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:30'],
            'stock' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ],[
            'name.required'  => 'Nama harus diisi.',
            'stock.required' => 'Stok harus diisi.',
            'price.required' => 'Harga harus diisi.',
            'name.string'    => 'Nama harus berupa teks.',
            'stock.numeric'  => 'Stok harus berupa angka.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'name.max'       => 'Nama tidak boleh melebihi 30 karakter.',
            'stock.min'      => 'Stok tidak boleh kurang dari 0.',
            'price.min'      => 'Harga tidak boleh kurang dari 0.',
        ]);  

        $product = new Product($validated);
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:30'],
            'stock' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ],[
            'name.required'  => 'Nama harus diisi.',
            'stock.required' => 'Stok harus diisi.',
            'price.required' => 'Harga harus diisi.',
            'name.string'    => 'Nama harus berupa teks.',
            'stock.numeric'  => 'Stok harus berupa angka.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'name.max'       => 'Nama tidak boleh melebihi 30 karakter.',
            'stock.min'      => 'Stok tidak boleh kurang dari 0.',
            'price.min'      => 'Harga tidak boleh kurang dari 0.',
        ]);        

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
