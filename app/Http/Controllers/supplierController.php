<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\ItemSupplier;
use Illuminate\Http\Request;
use App\Models\Barang;
use NumberFormatter;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('items')->get();
        $items = ItemSupplier::all();
        $total = 0;

        foreach ($items as $item) {
            $subtotal = $item->subtotal;
            $total += $subtotal;
        }
        $totalBelanja = $this->formatCurrency($total);
        return view('pages/supplier/index', compact('suppliers', 'totalBelanja'));
    }
    private function formatCurrency($amount)
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, 'IDR');
    }
    public function create()
    {
        $barangs = Barang::all();

        return view('pages/supplier/create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $supplierData = $request->only(['nama_supplier', 'no_nota']);
        $itemsData = $request->get('items');

        $supplier = Supplier::create($supplierData);

        foreach ($itemsData as $itemData) {
            $itemData['id_supplier'] = $supplier->id;
            ItemSupplier::create($itemData);

            $jml_satuan = $itemData['total_kertas'] * 500;
            $barang = Barang::find($itemData['id_barang']);
            $barang->stok += $jml_satuan;
            $barang->save();
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier and items created successfully.');
    }

    public function edit($id)
    {
        $barangs = Barang::all();

        $supplier = Supplier::findOrFail($id);
        $items = $supplier->items;

        return view('pages/supplier/edit', compact('supplier', 'items', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $supplierData = $request->only(['nama_supplier', 'no_nota']);
        $itemsData = $request->get('items');

        $supplier = Supplier::findOrFail($id);
        $supplier->update($supplierData);

        // Delete existing items
        $supplier->items()->delete();

        // Create new items
        foreach ($itemsData as $itemData) {
            $itemData['id_supplier'] = $supplier->id;
            ItemSupplier::create($itemData);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier and items updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->items()->delete();
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier and items deleted successfully.');
    }
}