@extends('layouts.app')

@section('content')

    <h2>Daftar Produk</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Form -->
    <form class="mb-4" action="{{ route('products.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Cari produk" value="{{ request('keyword') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>
    <!-- End Search Form -->
     
    <table class="table">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
    {{ $products->links() }}

    <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk Baru</a>

@endsection
