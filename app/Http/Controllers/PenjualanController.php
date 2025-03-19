<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pelanggan', 'user', 'detailPenjualan')->get();
        // dd($penjualans);
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $barangs = Barang::all();
        return view('penjualan.create', compact('pelanggans', 'barangs'));
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'user', 'detailPenjualan.barang')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }


    public function store(Request $request)
    {
        Log::info('Request diterima untuk menyimpan penjualan.', ['request' => $request->all()]);

        $request->validate([
            'pelanggan_id' => 'nullable|exists:pelanggan,id',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barang,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            Log::info('Mulai transaksi database.');

            $penjualan = Penjualan::create([
                'no_faktur' => 'PNJ-' . now()->format('YmdHis'),
                'tgl_faktur' => now()->format('Y-m-d'),
                'pelanggan_id' => $request->pelanggan_id,
                'total_bayar' => $request->total_bayar,
                'user_id' => Auth::id()
            ]);

            Log::info('Penjualan berhasil dibuat.', ['penjualan_id' => $penjualan->id]);

            $totalBayar = 0;

            foreach ($request->barang_id as $key => $barang_id) {
                $jumlah = (int) $request->jumlah[$key];

                Log::info("Proses barang ke-$key", [
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah
                ]);

                $barang = Barang::findOrFail($barang_id);

                Log::info("Barang ditemukan.", ['nama_barang' => $barang->nama_barang, 'stok' => $barang->stok]);

                if ($barang->stok < $jumlah) {
                    Log::error("Stok tidak mencukupi.", ['barang_id' => $barang_id, 'stok' => $barang->stok, 'jumlah_diminta' => $jumlah]);
                    return back()->withErrors('Stok tidak mencukupi untuk barang ' . $barang->nama_barang);
                }

                $subTotal = $barang->harga_jual * $jumlah;
                $totalBayar += $subTotal;

                Log::info("Subtotal dihitung.", ['subtotal' => $subTotal]);

                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah,
                    'harga_jual' => $barang->harga_jual,
                    'sub_total' => $subTotal,
                ]);

                Log::info("Detail penjualan dibuat.", ['detail_penjualan' => [
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah,
                    'harga_jual' => $barang->harga_jual,
                    'sub_total' => $subTotal,
                ]]);

                $barang->decrement('stok', $jumlah);
                Log::info("Stok barang dikurangi.", ['barang_id' => $barang_id, 'stok_sekarang' => $barang->stok]);
            }

            DB::commit();
            Log::info("Transaksi berhasil disimpan.");

            return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Terjadi kesalahan dalam transaksi.', ['error' => $e->getMessage()]);
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
