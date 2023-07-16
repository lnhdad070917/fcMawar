@extends('app')

@section('content')
    <h2 class="text-center">Tambah stok</h2>
    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_supplier">Nama Supplier:</label>
            <input type="text" name="nama_supplier" class="form-control" id="nama_supplier">
        </div>
        <div class="form-group">
            <label for="no_nota">No. Nota:</label>
            <input type="text" name="no_nota" class="form-control" id="no_nota">
        </div>
        <h3>Items:</h3>

        <div id="items-container">
            <div class="item">
                <div class="form-group">
                    <label for="items[0][id_barang]">ID Barang:</label>
                    <select name="items[0][id_barang]" class="form-control">
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="items[0][total_kertas]">Total Rim:</label>
                    <input type="text" name="items[0][total_kertas]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="items[0][harga]">Harga/rim:</label>
                    <input type="text" name="items[0][harga]" class="form-control">
                </div>
                <hr class="bg-primary" />
            </div>
        </div>

        <button type="button" onclick="addNewItem()" class="btn btn-secondary">Tambah Item</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <script>
        let itemCount = 0;

        function addNewItem() {
            itemCount++;

            const itemTemplate = `
            <div class="item">
                <div class="form-group">
                    <label for="items[${itemCount}][id_barang]">ID Barang:</label>
                    <select name="items[${itemCount}][id_barang]" class="form-control">
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="items[${itemCount}][total_kertas]">Total Kertas:</label>
                    <input type="text" name="items[${itemCount}][total_kertas]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="items[${itemCount}][harga]">Harga:</label>
                    <input type="text" name="items[${itemCount}][harga]" class="form-control">
                </div>
            </div>
            <hr class="bg-primary" />
        `;

            document.getElementById('items-container').insertAdjacentHTML('beforeend', itemTemplate);
        }
    </script>
@endsection
