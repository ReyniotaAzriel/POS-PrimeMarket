@extends('layout.app')

@section('content')
<div class="container">
    <h2>Daftar Pembelian</h2>
    <a href="{{ route('pembelian.create') }}" class="btn btn-primary mb-3">Tambah Pembelian</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Masuk</th>
                <th>Tanggal Masuk</th>
                <th>Pemasok</th>
                <th>User</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembelians as $index => $pembelian)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pembelian->kode_masuk }}</td>
                <td>{{ $pembelian->tanggal_masuk }}</td>
                <td>{{ $pembelian->pemasok->nama_pemasok }}</td>
                <td>{{ $pembelian->user->name }}</td>
                <td>Rp {{ number_format($pembelian->total, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('pembelian.show', $pembelian->id) }}" class="btn btn-info">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
