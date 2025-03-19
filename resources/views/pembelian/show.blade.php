@extends('layout.app')

@section('content')
<div class="container">
    <h2>Detail Pembelian</h2>
    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h4>Kode Masuk: {{ $pembelian->kode_masuk }}</h4>
            <p><strong>Tanggal Masuk:</strong> {{ $pembelian->tanggal_masuk }}</p>
            <p><strong>Pemasok:</strong> {{ $pembelian->pemasok->nama_pemasok }}</p>
            <p><strong>User:</strong> {{ $pembelian->user->name }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($pembelian->total, 0, ',', '.') }}</p>
        </div>
    </div>

    <h3 class="mt-4">Detail Barang</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembelian->detailPembelian as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->barang->nama_barang }}</td>
                <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
