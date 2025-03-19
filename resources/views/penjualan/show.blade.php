@extends('layout.app')

@section('content')
<div class="container">
    <h2>Detail Penjualan</h2>

    <div class="card mb-3">
        <div class="card-header">
            <strong>No Faktur:</strong> {{ $penjualan->no_faktur }}
        </div>
        <div class="card-body">
            <p><strong>Tanggal Faktur:</strong> {{ $penjualan->tgl_faktur }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</p>
            <p><strong>Pelanggan:</strong>
                @if($penjualan->pelanggan)
                    {{ $penjualan->pelanggan->nama }}
                @else
                    <span class="text-muted">Tidak Ada Pelanggan</span>
                @endif
            </p>
            <p><strong>Kasir:</strong> {{ $penjualan->user->name }}</p>
        </div>
    </div>

    <h4>Detail Barang</h4>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->detailPenjualan as $detail)
            <tr>
                <td>{{ $detail->barang->nama_barang }}</td>
                <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
