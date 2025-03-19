<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\file;
use Illuminate\Support\Facades\Schema;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kategori::truncate();
        Schema::enableForeignKeyConstraints();
        $file = File::get('database/data/kategori.json');
        $data = json_decode($file, true);
        foreach($data as $item) {
            Kategori::create([
                'id' => $item->id,
                'nama_kategori' => $item->nama_kategori,
            ]);
        }
    }
}
