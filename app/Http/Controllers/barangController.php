<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('pages/barang/index', compact('barangs'));
    }

    public function create()
    {
        return view('pages/barang/create');
    }

    public function store(Request $request)
    {
        Barang::create($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('pages/barang/edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                $errorMessage = "Tidak dapat menghapus barang karena sudah terhubung dengan tabel supplier. Mohon hapus atau ubah data yang terkait di tabel supplier terlebih dahulu.";
                echo "<script>alert('" . $errorMessage . "'); window.history.back();</script>";
            } else {
                echo $e->getMessage();
            }
        }

    }

}