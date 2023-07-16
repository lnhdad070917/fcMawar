@extends('app')

@section('content')
    <h2 class="text-center pb-3">Table Supplier</h2>

    <h2 class="text-end">Total: {{ $totalBelanja }}</h2>
    <a href="{{ route('supplier.create') }}" class="btn btn-primary">Add Supplier</a>

    <div class="pt-4">
        <table id="table" class="table display" style="width: 100%">
            <thead>
                <tr>
                    <th>Nama Supplier</th>
                    <th>No. Nota</th>
                    <th>Items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->nama_supplier }}</td>
                        <td>{{ $supplier->no_nota }}</td>
                        <td>
                            <ul>
                                @foreach ($supplier->items as $item)
                                    <li>{{ $item->barang->nama_barang }} - Total rim: {{ $item->total_kertas }} -
                                        Harga:
                                        {{ $item->harga }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
