@extends('layout.app')

@section('content')
<div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2 class="mb-4">Daftar Penjualan</h2>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Faktur</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{--  @dd($penjualans)  --}}
            @foreach ($penjualans as $penjualanss)
            <tr>
                <td>{{ $penjualanss->no_faktur }}</td>
                <td>{{ $penjualanss->tgl_faktur }}</td>
                <td>{{ $penjualanss->pelanggan->nama?? 'pelanggan umum'}}</td>
                <td>Rp {{ number_format($penjualanss->detailPenjualan->sum('sub_total'), 0, ',', '.') }}</td>


                <td>
                    <a href="{{ route('penjualan.show', $penjualanss->id) }}" class="btn btn-info btn-sm">Detail</a>
                    {{--  <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>  --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
