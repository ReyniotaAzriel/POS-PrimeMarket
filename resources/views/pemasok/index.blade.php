@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Manajemen Pemasok</h4>
                    <a href="{{ route('pemasok.create') }}" class="btn btn-success">Tambah Pemasok</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pemasok</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasok as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_pemasok }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->nomor_telepon }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->catatan }}</td>
                                    <td>
                                        <a href="{{ route('pemasok.show', $p->id) }}" class="btn btn-info btn-sm">Lihat</a>

                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $p->id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('pemasok.destroy', $p->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pemasok ini?')"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $p->id }}">
                                                    Edit Pemasok
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('pemasok.update', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="edit_nama_pemasok{{ $p->id }}" class="form-label">Nama Pemasok</label>
                                                        <input type="text" name="nama_pemasok"
                                                            id="edit_nama_pemasok{{ $p->id }}"
                                                            class="form-control"
                                                            value="{{ $p->nama_pemasok }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_alamat{{ $p->id }}" class="form-label">Alamat</label>
                                                        <textarea name="alamat" id="edit_alamat{{ $p->id }}"
                                                            class="form-control">{{ $p->alamat }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_nomor_telepon{{ $p->id }}" class="form-label">Nomor Telepon</label>
                                                        <input type="text" name="nomor_telepon"
                                                            id="edit_nomor_telepon{{ $p->id }}"
                                                            class="form-control"
                                                            value="{{ $p->nomor_telepon }} ">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_email{{ $p->id }}" class="form-label">Email</label>
                                                        <input type="email" name="email"
                                                            id="edit_email{{ $p->id }}"
                                                            class="form-control"
                                                            value="{{ $p->email }} ">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_catatan{{ $p->id }}" class="form-label">Catatan</label>
                                                        <textarea name="catatan" id="edit_catatan{{ $p->id }}"
                                                            class="form-control">{{ $p->catatan }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @endforeach
                        </tbody>
                    </table>

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
