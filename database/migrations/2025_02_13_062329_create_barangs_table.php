<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('barang', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang', 50)->unique();
        $table->string('nama_barang', 100);
        $table->string('satuan', 10);
        $table->double('harga_jual');
        $table->integer('stok');
        $table->boolean('ditarik')->default(false);
        $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('gambar')->nullable(); // Tambahkan kolom gambar
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
