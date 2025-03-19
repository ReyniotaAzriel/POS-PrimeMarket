<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Barang;

class DetailPembelianController extends Controller
{
    public function index()
    {
        $details = DetailPembelian::with('pembelian', 'barang')->get();
        $pembelians = Pembelian::all();
        $barangs = Barang::all();

        return view('detail_pembelian.index', compact('details', 'pembelians', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:pembelian,id',
            'barang_id' => 'required|exists:barang,id',
            'harga_beli' => 'required|numeric',
            'jumlah' => 'required|integer',
            'sub_total' => 'required|numeric',
        ]);

        DetailPembelian::create($request->all());

        return redirect()->route('detail_pembelian.index')->with('success', 'Detail Pembelian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $detail = DetailPembelian::findOrFail($id);
        $pembelians = Pembelian::all();
        $barangs = Barang::all();

        return view('detail_pembelian.index', compact('detail', 'pembelians', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:pembelian,id',
            'barang_id' => 'required|exists:barang,id',
            'harga_beli' => 'required|numeric',
            'jumlah' => 'required|integer',
            'sub_total' => 'required|numeric',
        ]);

        $detail = DetailPembelian::findOrFail($id);
        $detail->update($request->all());

        return redirect()->route('detail_pembelian.index')->with('success', 'Detail Pembelian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detail = DetailPembelian::findOrFail($id);
        $detail->delete();

        return redirect()->route('detail_pembelian.index')->with('success', 'Detail Pembelian berhasil dihapus.');
    }

    public function show($id)
    {
        $detail = DetailPembelian::with(['pembelian', 'barang'])->findOrFail($id);
        return view('detail_pembelian.index', compact('detail'));
    }
}
