<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $history = $product->stockMovements()->latest()->get();
        return view('products.show', compact('product', 'history'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        Product::create($request->only('name', 'uom', 'qty'));
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'uom', 'qty'));
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function addStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $product = Product::findOrFail($id);
        $product->qty += $request->quantity;
        $product->save();

        StockMovement::create([
            'product_id' => $product->id,
            'type' => 'receipt',
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('products.show', $product->id)->with('success', 'Stok berhasil ditambahkan.');
    }

    public function reduceStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $product = Product::findOrFail($id);

        if ($product->qty < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        $product->qty -= $request->quantity;
        $product->save();

        StockMovement::create([
            'product_id' => $product->id,
            'type' => 'used',
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('products.show', $product->id)->with('success', 'Stok berhasil dikurangi.');
    }

    public function exportCsv()
    {
        $products = Product::all();

        $filename = 'products.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Nama Produk', 'Stok', 'Harga']);

        foreach ($products as $product) {
            fputcsv($handle, [
                $product->id,
                $product->name,
                $product->stock,
                $product->price,
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

}
