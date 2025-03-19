<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Sesuai dengan nama tabel di database

    protected $fillable = ['nama_kategori']; // Sesuai dengan field di tabel

    public $timestamps = true; // Jika tabel memiliki created_at dan updated_at, tetap aktifkan.
}
