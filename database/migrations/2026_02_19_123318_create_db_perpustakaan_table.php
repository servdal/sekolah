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
        Schema::connection('simaster')->create('db_perpustakaan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('gambar');
            $table->text('judul');
            $table->string('link');
            $table->string('kodebuku', 50)->nullable();
            $table->string('pengarang', 150)->nullable();
            $table->string('cetakan', 10)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->year('tahun')->nullable();
            $table->string('ilustrasi', 50)->nullable();
            $table->integer('halaman')->nullable();
            $table->integer('id_sekolah')->nullable();
            $table->string('isbn', 100)->nullable();
            $table->string('tglmasuk', 50)->nullable();
            $table->year('tahunperolehan')->nullable();
            $table->string('jenisperolehan', 15)->nullable();
            $table->string('rakbuku', 50)->nullable();
            $table->string('kondisi', 50)->nullable();
            $table->string('kategori', 50)->nullable();
            $table->string('inputor', 150)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_perpustakaan');
    }
};
