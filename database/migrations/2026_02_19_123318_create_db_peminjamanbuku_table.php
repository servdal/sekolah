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
        Schema::connection('simaster')->create('db_peminjamanbuku', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('kodebuku')->nullable();
            $table->string('pengarang', 150)->nullable();
            $table->string('judul', 150)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->string('isbn', 100)->nullable();
            $table->date('tglpinjam')->nullable();
            $table->date('tglkembali');
            $table->integer('biaya');
            $table->integer('denda');
            $table->string('peminjam', 150);
            $table->string('noinduk', 35);
            $table->string('kelas', 15);
            $table->string('inputor', 150)->nullable();
            $table->integer('status');
            $table->integer('id_sekolah');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_peminjamanbuku');
    }
};
