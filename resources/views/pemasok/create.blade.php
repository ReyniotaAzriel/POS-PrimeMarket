@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Tambah Pemasok</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pemasok.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                            <input type="text" name="nama_pemasok" id="nama_pemasok"
                                class="form-control @error('nama_pemasok') is-invalid @enderror"
                                placeholder="Masukkan nama pemasok" required>
                            @error('nama_pemasok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon"
                                class="form-control" placeholder="Masukkan nomor telepon">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" placeholder="Masukkan catatan"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Pemasok</button>
                        <a href="{{ route('pemasok.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
