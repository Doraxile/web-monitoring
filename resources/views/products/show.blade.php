@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Produk</h1>

    {{-- Tombol Kembali --}}
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Produk</a>

    {{-- Informasi Produk --}}
    <div class="mb-4 border p-3 rounded bg-white shadow-sm">
        <strong>Nama:</strong> {{ $product->name }} <br>
        <strong>UOM:</strong> {{ $product->uom }} <br>
        <strong>Qty Saat Ini:</strong> {{ $product->qty }}
    </div>

    {{-- Form Tambah dan Kurangi Stok --}}
    <div class="row">
        <div class="col-md-6">
            <!-- Form Tambah Stok -->
            <form action="{{ route('products.receipt', $product->id) }}" method="POST" class="mb-4 border p-3 rounded shadow-sm bg-light">
                @csrf
                <h5 class="mb-3">Tambah Stok</h5>
                <div class="mb-3">
                    <label class="form-label">Jumlah Tambah:</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan:</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Tambah</button>
            </form>
        </div>

        <div class="col-md-6">
            <!-- Form Kurangi Stok -->
            <form action="{{ route('products.used', $product->id) }}" method="POST" class="mb-4 border p-3 rounded shadow-sm bg-light">
                @csrf
                <h5 class="mb-3">Kurangi Stok</h5>
                <div class="mb-3">
                    <label class="form-label">Jumlah Kurang:</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan:</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <button type="submit" class="btn btn-danger">Kurangi</button>
            </form>
        </div>
    </div>

    <hr>
    <h4 class="mt-4">Riwayat Perubahan Stok</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($history as $log)
            <tr>
                <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    @if($log->type == 'receipt')
                        <span class="badge bg-success">Masuk</span>
                    @else
                        <span class="badge bg-danger">Keluar</span>
                    @endif
                </td>
                <td>{{ $log->quantity }}</td>
                <td>{{ $log->description }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada histori stok.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
