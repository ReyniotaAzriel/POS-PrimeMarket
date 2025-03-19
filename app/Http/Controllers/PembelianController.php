<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Pemasok;
use App\Models\User;
use App\Models\DetailPembelian;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with(['pemasok', 'user'])->orderBy('tanggal_masuk', 'desc')->get();
        return view('pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $pemasoks = Pemasok::all();
        $users = User::all();
        $barangs = Barang::all();
        return view('pembelian.create', compact('pemasoks', 'users', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'pemasok_id' => 'required|exists:pemasok,id',
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|array',
            'harga_beli.*' => 'required|numeric|min:0',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        // Generate kode_masuk otomatis
        $kodeMasuk = 'PMB-' . now()->format('YmdHis');

        // Hitung total pembelian
        $total = array_sum(array_map(function ($harga, $jumlah) {
            return $harga * $jumlah;
        }, $request->harga_beli, $request->jumlah));

        // Simpan ke database
        $pembelian = Pembelian::create([
            'kode_masuk' => $kodeMasuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'pemasok_id' => $request->pemasok_id,
            'user_id' => $request->user_id,
            'total' => $total,
        ]);

        // Simpan detail pembelian & update stok barang
        foreach ($request->barang_id as $index => $barang_id) {
            $hargaBeli = $request->harga_beli[$index];
            $jumlah = $request->jumlah[$index];
            $subTotal = $hargaBeli * $jumlah;

            // Simpan detail pembelian
            DetailPembelian::create([
                'pembelian_id' => $pembelian->id,
                'barang_id' => $barang_id,
                'harga_beli' => $hargaBeli,
                'jumlah' => $jumlah,
                'sub_total' => $subTotal,
            ]);

            // Update stok barang
            Barang::where('id', $barang_id)->increment('stok', $jumlah);
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil disimpan dan stok barang diperbarui!');
    }







    public function show($id)
    {
        $pembelian = Pembelian::with(['pemasok', 'user', 'detailPembelian.barang'])->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }
}
