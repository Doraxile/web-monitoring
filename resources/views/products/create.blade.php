@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Tambah Produk Baru</h2>

    <form action="{{ route('products.store') }}" method="POST" class="border p-4 rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="uom" class="form-label">Satuan (UOM)</label>
            <input type="text" name="uom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="qty" class="form-label">Jumlah Awal</label>
            <input type="number" name="qty" class="form-control" required>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
