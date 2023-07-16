<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPembayaran;
use App\Models\ItemTransaksi;
use App\Models\Pembayaran;
use App\Models\Barang;
use Illuminate\Http\Request;
use NumberFormatter;

class TransaksiPembayaranController extends Controller
{
    public function index()
    {
        $total = TransaksiPembayaran::join('pembayaran', 'transaksi_pembayaran.id', '=', 'pembayaran.id_transaksi')
            ->sum('pembayaran.total_bayar');
        $totalBayar = $this->formatCurrency($total);
        $transaksis = TransaksiPembayaran::with('pembayaran')->get();
        return view('pages/transaksi/index', compact('transaksis', 'totalBayar'));
    }

    private function formatCurrency($amount)
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, 'IDR');
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('pages/transaksi/create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $transaksi = TransaksiPembayaran::create([
            'tgl_transaksi' => $request->input('tgl_transaksi'),
            'ket' => $request->input('ket'),
        ]);

        $items = $request->input('items');
        foreach ($items as $item) {
            $barang = Barang::find($item['id_barang']);
            $jumlahBarang = $item['jml_barang'];
            $jml_satuan = $jumlahBarang * 500;
            $barang->stok -= $jml_satuan;
            $barang->save();


            $transaksi->items()->create([
                'id_barang' => $item['id_barang'],
                'jml_barang' => $jumlahBarang,
            ]);
        }

        return redirect()->route('transaksi.createPembayaran', ['transaksi_id' => $transaksi->id])->with('success', 'Data transaksi berhasil disimpan.');
    }

    public function show($id)
    {
        $transaksi = TransaksiPembayaran::with('items')->find($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function createPembayaran($transaksi_id)
    {
        $transaksi = TransaksiPembayaran::findOrFail($transaksi_id);
        $totalBayar = 0;
        foreach ($transaksi->items as $item) {
            $barang = Barang::find($item->id_barang);
            // var_dump($barang->harga_rim);
            // die();
            $totalBayar += $item->jml_barang * $barang->harga_rim;
        }
        return view('pages/transaksi/pembayaran', compact('transaksi', 'totalBayar'));

    }

    public function storePembayaran(Request $request)
    {
        $transaksi_id = $request->input('transaksi_id');

        Pembayaran::create([
            'id_transaksi' => $transaksi_id,
            'total_bayar' => $request->input('total_bayar'),
            'tgl_bayar' => $request->input('tgl_bayar'),
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function edit($transaksi)
    {
        $transaksiPembayaran = TransaksiPembayaran::with('items')->findOrFail($transaksi);
        $barangs = Barang::all();
        return view('pages/transaksi/edit', compact('transaksi', 'barangs', 'transaksiPembayaran'));
    }

    public function update(Request $request, TransaksiPembayaran $transaksi)
    {
        $transaksi->update([
            'tgl_transaksi' => $request->input('tgl_transaksi'),
            'ket' => $request->input('ket'),
        ]);

        $transaksi->items()->delete();

        $items = $request->input('items');
        foreach ($items as $item) {
            ItemTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_barang' => $item['id_barang'],
                'jml_barang' => $item['jml_barang'],
            ]);
        }

        $transaksi->pembayaran()->update([
            'total_bayar' => $request->input('total_bayar'),
            'tgl_bayar' => $request->input('tgl_bayar'),
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(TransaksiPembayaran $transaksi)
    {
        $transaksi->items()->delete();
        $transaksi->pembayaran()->delete();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}