<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;

    protected $table = 'pemasok';

    protected $fillable = [
        'nama_pemasok',
        'alamat',
        'nomor_telepon',
        'email',
        'catatan',
    ];

    /**
     * Relasi ke tabel pembelian
     * Satu pemasok bisa memiliki banyak pembelian
     */
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'pemasok_id');
    }
}
