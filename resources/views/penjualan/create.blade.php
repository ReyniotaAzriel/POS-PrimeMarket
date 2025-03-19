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
    <h2>Tambah Penjualan</h2>
    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="no_faktur" class="form-label">No Faktur</label>
            <input type="text" name="no_faktur" id="no_faktur" class="form-control" value="PNJ-{{ now()->format('YmdHis') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tgl_faktur" class="form-label">Tanggal Faktur</label>
            <input type="date" name="tgl_faktur" id="tgl_faktur" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan (Opsional)</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                <option value="">Tanpa Pelanggan</option> <!-- Opsional -->
                @foreach ($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="barang_id" class="form-label">Barang</label>
            <select name="barang_id[]" id="barang_id" class="form-control" multiple required>
                @foreach ($barangs as $barang)
                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah[]" id="jumlah" class="form-control" required>
        </div>
            <input type="hidden" name="=harga_jual[]" id="=harga_jual" class="form-control" required>


        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar</label>
            <input type="text" name="total_bayar" id="total_bayar" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
<script>
    {{--  console.log('test')  --}}
    document.getElementById('barang_id').addEventListener('change', function() {
        let total = 0;
        let barangSelect = this;
        let jumlahInput = document.getElementById('jumlah');


        for (let option of barangSelect.options) {
            if (option.selected) {
                let harga = option.getAttribute('data-harga');
                total += parseInt(harga) * parseInt(jumlahInput.value || 1);
            }
        }


        document.getElementById('total_bayar').value = total;
    });



</script>
@endsection
