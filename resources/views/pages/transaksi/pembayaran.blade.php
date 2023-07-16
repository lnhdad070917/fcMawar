@extends('app')

@section('content')
    <h2 class="text-center pb-3">Tambah Pembeli - Input Pembayaran</h2>

    <form action="{{ route('transaksi.storePembayaran') }}" method="POST">
        @csrf
        <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
        <div class="form-group">
            <label for="total_bayar">Total Bayar:</label>
            <input class="form-control" type="number" name="total_bayar" value="{{ $totalBayar }}">
        </div>
        <div class="form-group">
            <label for="tgl_bayar">Tanggal Bayar:</label>
            <input class="form-control" type="datetime-local" name="tgl_bayar" value="{{ date('Y-m-d\TH:i') }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
