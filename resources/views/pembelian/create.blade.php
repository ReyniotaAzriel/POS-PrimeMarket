@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Pembelian</h2>
    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf

        {{-- Tanggal Masuk --}}
        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
        </div>

        {{-- Pemasok --}}
        <div class="mb-3">
            <label for="pemasok_id" class="form-label">Pemasok</label>
            <select class="form-control" id="pemasok_id" name="pemasok_id" required>
                <option value="">Pilih Pemasok</option>
                @foreach($pemasoks as $pemasok)
                    <option value="{{ $pemasok->id }}">{{ $pemasok->nama_pemasok }}</option>
                @endforeach
            </select>
        </div>

        {{-- User --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <h4>Detail Barang</h4>
        <div id="barang-container">
            <div class="row mb-2 barang-row">
                <div class="col-md-4">
                    <label>Barang</label>
                    <select name="barang_id[]" class="form-control barang-select" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli[]" class="form-control harga-beli" required>
                </div>
                <div class="col-md-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control jumlah" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-barang">Hapus</button>
                </div>
            </div>
        </div>

        <button type="button" id="add-barang" class="btn btn-primary">Tambah Barang</button>

        {{-- Total Harga --}}
        <div class="mb-3 mt-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" readonly>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('add-barang').addEventListener('click', function() {
        let container = document.getElementById('barang-container');
        let row = document.createElement('div');
        row.classList.add('row', 'mb-2', 'barang-row');
        row.innerHTML = `
            <div class="col-md-4">
                <select name="barang_id[]" class="form-control barang-select" required>
                    <option value="">Pilih Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="harga_beli[]" class="form-control harga-beli" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="jumlah[]" class="form-control jumlah" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-barang">Hapus</button>
            </div>
        `;
        container.appendChild(row);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-barang')) {
            e.target.closest('.barang-row').remove();
            hitungTotal();
        }
    });

    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('harga-beli') || e.target.classList.contains('jumlah')) {
            hitungTotal();
        }
    });

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.barang-row').forEach(row => {
            let harga = row.querySelector('.harga-beli').value || 0;
            let jumlah = row.querySelector('.jumlah').value || 0;
            total += (parseFloat(harga) * parseFloat(jumlah));
        });
        document.getElementById('total').value = total;
    }
</script>

@endsection
