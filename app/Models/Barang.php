<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga_jual',
        'stok',
        'kategori_id',
        'ditarik',
        'user_id',
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'barang_id');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'barang_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Fungsi untuk menambah stok barang setelah pembelian
     *
     * @param int $jumlah
     */
    public function tambahStok($jumlah)
    {
        $this->stok += $jumlah;
        $this->save();
    }
}
