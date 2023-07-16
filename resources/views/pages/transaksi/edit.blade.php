@extends('app')

@section('content')
    <form action="{{ route('transaksi.update', $transaksiPembayaran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_barang">ID Barang:</label>
            <select class="form-control" name="id_barang">
                <option value="">Pilih Barang</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}"
                        {{ $barang->id == $transaksiPembayaran->id_barang ? 'selected' : '' }}>
                        {{ $barang->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tgl_transaksi">Tanggal Transaksi:</label>
            <input type="datetime-local" class="form-control" name="tgl_transaksi"
                value="{{ $transaksiPembayaran->tgl_transaksi }}">
        </div>

        <div class="form-group">
            <label for="ket">Keterangan:</label>
            <input type="text" class="form-control" name="ket" value="{{ $transaksiPembayaran->ket }}">
        </div>

        <div id="items-container">
            @foreach ($transaksiPembayaran->items as $index => $item)
                <div class="item">
                    <div class="form-group">
                        <label for="items[{{ $index }}][id_barang]">ID Barang:</label>
                        <select class="form-control" name="items[{{ $index }}][id_barang]">
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" {{ $barang->id == $item->id_barang ? 'selected' : '' }}>
                                    {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="items[{{ $index }}][jml_barang]">Jumlah Barang:</label>
                        <input type="number" class="form-control" name="items[{{ $index }}][jml_barang]"
                            value="{{ $item->jml_barang }}">
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary" id="add-item-btn">Tambah Item</button>

        <div class="form-group">
            <label for="total_bayar">Total Bayar:</label>
            <input type="number" class="form-control" name="total_bayar"
                value="{{ $transaksiPembayaran->pembayaran->total_bayar }}">
        </div>

        <div class="form-group">
            <label for="tgl_bayar">Tanggal Bayar:</label>
            <input type="datetime-local" class="form-control" name="tgl_bayar"
                value="{{ $transaksiPembayaran->pembayaran->tgl_bayar }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        let itemCount = {{ count($transaksiPembayaran->items) }};
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
                    <input type="number" class="form-control" name="items[${itemCount}][jml_barang]">
                </div>
            `;

            itemsContainer.appendChild(item);
        });
    </script>
@endsection
