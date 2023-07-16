@extends('app')

@section('content')
    <h1>Edit Barang</h1>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}"
                required>
        </div>
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"
                value="{{ $barang->harga_satuan }}" required>
        </div>
        <div class="form-group">
            <label for="harga_rim">Harga Rim</label>
            <input type="number" class="form-control" id="harga_rim" name="harga_rim" value="{{ $barang->harga_rim }}"
                required>
        </div>
        <div class="form-group">
            <label for="stok">Stok (/lembar)</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ $barang->stok }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
