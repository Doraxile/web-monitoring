@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
    
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>UOM</th>
                <th>Qty</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->uom }}</td>
                <td>{{ $product->qty }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada produk ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<a href="{{ route('products.export') }}" class="btn btn-success mb-3">
    Export ke CSV
</a>
@endsection
