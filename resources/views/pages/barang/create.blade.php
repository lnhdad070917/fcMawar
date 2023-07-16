<!-- resources/views/barang/create.blade.php -->

@extends('app')

@section('content')
    <h2 class="text-center">Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_barang">Nama Barang (nama-merk)</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
        </div>
        <div class="form-group">
            <label for="harga_rim">Harga Rim</label>
            <input type="number" class="form-control" id="harga_rim" name="harga_rim" required>
        </div>

        <div id="rim-form" style="display: block;">
            <div class="form-group">
                <label for="stok_rim">Stok (/Rim)</label>
                <input type="number" class="form-control" id="stok_rim" name="stok">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <script>
            function updateStokValue(selectElement) {
                var stokStuanForm = document.getElementById('satuan-form');
                var stokRimForm = document.getElementById('rim-form');

                if (selectElement.value === 'satuan') {
                    stokStuanForm.style.display = 'block';
                    stokRimForm.style.display = 'none';
                } else if (selectElement.value === 'rim') {
                    stokStuanForm.style.display = 'none';
                    stokRimForm.style.display = 'block';
                }
            }

            document.querySelector('form').addEventListener('submit', function(event) {
                var inputElement = document.getElementById('stok_rim');

                if (inputElement) {
                    var stokValue = parseFloat(inputElement.value);
                    if (!isNaN(stokValue)) {
                        inputElement.value = stokValue * 500;
                    }
                }
            });
        </script>
    </form>
@endsection
