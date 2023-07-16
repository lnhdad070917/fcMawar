@extends('app')

@section('content')
    <h2 class="text-center pb-3">Tambah Pembeli - Input Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tgl_transaksi">Tanggal Transaksi:</label>
            <input class="form-control" type="datetime-local" name="tgl_transaksi" value="{{ date('Y-m-d\TH:i') }}">
        </div>
        <div class="form-group">
            <label for="ket">Keterangan:</label>
            <input class="form-control" type="text" name="ket" value="-">
        </div>

        <div id="items-container">
            <div class="item">
                <div class="form-group">
                    <label for="items[0][id_barang]">ID Barang:</label>
                    <select class="form-control" name="items[0][id_barang]">
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="items[0][jml_barang]">Jumlah barang (/Rim):</label>
                    <input class="form-control" type="number" name="items[0][jml_barang]">
                </div>
                <hr class="bg-primary" />
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="add-item-btn">Tambah Item</button>
        <button type="submit" class="btn btn-primary">Submit</button>

        <script>
            let itemCount = 0;
            const addItemBtn = document.getElementById('add-item-btn');
            const itemsContainer = document.getElementById('items-container');

            addItemBtn.addEventListener('click', () => {
                itemCount++;

                const item = document.createElement('div');
                item.className = 'item';

                item.innerHTML = `
                    <div class="form-group">
                        <label for="items[${itemCount}][id_barang]">ID Barang:</label>
                        <select class="form-control" name="items[${itemCount}][id_barang]">
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="items[${itemCount}][jml_barang]">Jumlah Barang:</label>
                        <input class="form-control" type="number" name="items[${itemCount}][jml_barang]">
                    </div>
                    <hr class="bg-primary" />
                `;

                itemsContainer.appendChild(item);
            });
        </script>
    </form>
@endsection
