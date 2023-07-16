@extends('app')

@section('content')
    <h2 class="text-center">Edit Data Supplier</h2>
    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_supplier">Nama Supplier:</label>
            <input type="text" name="nama_supplier" id="nama_supplier" class="form-control"
                value="{{ $supplier->nama_supplier }}">
        </div>
        <div class="form-group">
            <label for="no_nota">No. Nota:</label>
            <input type="text" name="no_nota" id="no_nota" class="form-control" value="{{ $supplier->no_nota }}">
        </div>
        <h3>Items:</h3>

        <div id="items-container">
            @foreach ($items as $index => $item)
                <div class="item">
                    <div class="form-group">
                        <label for="items[{{ $index }}][id_barang]">ID Barang:</label>
                        <input type="text" name="items[{{ $index }}][id_barang]" class="form-control"
                            value="{{ $item->id_barang }}">
                    </div>
                    <div class="form-group">
                        <label for="items[{{ $index }}][total_kertas]">Total Kertas:</label>
                        <input type="text" name="items[{{ $index }}][total_kertas]" class="form-control"
                            value="{{ $item->total_kertas }}">
                    </div>
                    <div class="form-group">
                        <label for="items[{{ $index }}][harga]">Harga:</label>
                        <input type="text" name="items[{{ $index }}][harga]" class="form-control"
                            value="{{ $item->harga }}">
                    </div>
                    <hr class="bg-primary" />
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addNewItem()">Tambah Item</button>
        <button type="submit">Simpan</button>
    </form>

    <script>
        let itemCount = {{ count($items) }};

        function addNewItem() {
            itemCount++;

            const itemTemplate = `
            <div class="item">
                <div class="form-group">
                    <label for="items[${itemCount}][id_barang]">ID Barang:</label>
                    <input type="text" name="items[${itemCount}][id_barang]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="items[${itemCount}][total_kertas]">Total Kertas:</label>
                    <input type="text" name="items[${itemCount}][total_kertas]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="items[${itemCount}][harga]">Harga:</label>
                    <input type="text" name="items[${itemCount}][harga]" class="form-control">
                </div>
                <hr class="bg-primary" />
            </div>
        `;

            document.getElementById('items-container').insertAdjacentHTML('beforeend', itemTemplate);
        }
    </script>
@endsection
