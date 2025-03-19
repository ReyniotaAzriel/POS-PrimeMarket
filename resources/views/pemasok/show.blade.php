@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pemasok</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pemasok</th>
                            <td>{{ $pemasok->nama_pemasok }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pemasok->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>{{ $pemasok->nomor_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $pemasok->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $pemasok->catatan ?? '-' }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('pemasok.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
