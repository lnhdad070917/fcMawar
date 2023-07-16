@extends('app')

@section('content')
    <h1 class="text-center">Daftar Barang</h1>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>
    <table id="table" class="table display" style="width: 100%">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Harga Rim</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td class="text-end">{{ $barang->harga_satuan }}</td>
                    <td class="text-end">{{ $barang->harga_rim }}</td>
                    <td class="text-end">
                        <?php
                        if ($barang->stok >= 500) {
                            $rim = floor($barang->stok / 500);
                            $sisa = $barang->stok % 500;
                            echo $rim . ' rim ' . $sisa . ' lembar';
                        } else {
                            echo $barang->stok . ' lembar ';
                        }
                        ?>
                    </td>

                    <td>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
