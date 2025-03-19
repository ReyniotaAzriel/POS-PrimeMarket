<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Tampilkan daftar barang
    public function index()
    {
        $barangs = Barang::with('kategori')->get(); // Mengambil barang dengan kategori
        return view('barang.index', compact('barangs'));
    }

    // Tampilkan form tambah barang
    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori untuk dropdown
        return view('barang.create', compact('kategoris'));
    }

    // Simpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $newKode = 'BRG' . str_pad(Barang::count() + 1, 3, '0', STR_PAD_LEFT);

        // Simpan gambar jika ada
        $fileName = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/produk'), $fileName);
        }

        Barang::create([
            'kode_barang' => $newKode,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id, // Simpan kategori
            'user_id' => auth()->id() ?? 1,
            'gambar' => $fileName,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Tampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all(); // Ambil kategori untuk dropdown
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    // Update barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update data barang
        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
        ]);

        // Jika ada gambar baru, hapus yang lama lalu simpan yang baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && file_exists(public_path("file/produk/{$barang->gambar}"))) {
                unlink(public_path("file/produk/{$barang->gambar}"));
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/produk'), $fileName);
            $barang->update(['gambar' => $fileName]);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }


    // Hapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus gambar jika ada
        if ($barang->gambar) {
            unlink(public_path("file/produk/$barang->gambar"));
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
