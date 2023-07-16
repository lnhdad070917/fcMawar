@extends('app')

@section('content')
    <h2 class="text-center">Table Pembelian</h2>

    <h2 class="text-end">Total : {{ $totalBayar }}</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>

    <table id="table" class="table display" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Transaksi</th>
                <th>Keterangan</th>
                <th>Items</th>
                <th>Total Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->tgl_transaksi }}</td>
                    <td>{{ $transaksi->ket }}</td>
                    <td>
                        <ul>
                            @foreach ($transaksi->items as $item)
                                <li>{{ $item->barang->nama_barang }} - {{ $item->jml_barang }} lembar
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $transaksi->pembayaran->total_bayar ?? '_' }}</td>
                    <td>{{ $transaksi->pembayaran->tgl_bayar ?? '_' }}</td>
                    <td>
                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
