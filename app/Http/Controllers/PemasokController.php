<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
        $pemasok = Pemasok::all();
        return view('pemasok.index', compact('pemasok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'catatan' => 'nullable|string|max:500',
        ]);

        Pemasok::create([
            'nama_pemasok' => $request->nama_pemasok,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return view('pemasok.show', compact('pemasok'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'catatan' => 'nullable|string|max:500',
        ]);

        $pemasok = Pemasok::findOrFail($id);
        $pemasok->update([
            'nama_pemasok' => $request->nama_pemasok,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        $pemasok->delete();

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil dihapus.');
    }

    public function create()
    {
        return view('pemasok.create');
    }
}
