@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Manajemen Barang</h4>

        {{-- Tombol Menuju Halaman Tambah Barang --}}
        <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>

        {{-- Tabel Daftar Barang --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $barang->kode_barang }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->kategori ? $barang->kategori->nama_kategori : '-' }}</td>
                                <td>{{ $barang->satuan }}</td>
                                <td>{{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ $barang->stok }}</td>
                                <td class="text-center">
                                    @if ($barang->gambar)
                                        <img src="{{ asset('file/produk/' . $barang->gambar) }}" width="100" class="rounded" alt="Gambar Barang">
                                    @else
                                        Tidak Ada Gambar
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                                    </form>
                                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm mt-1">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
