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
        Schema::connection('simaster')->create('db_keuangan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tanggal');
            $table->integer('bulan');
            $table->year('tahun');
            $table->string('deskripsi');
            $table->integer('pemasukan');
            $table->integer('pengeluaran');
            $table->integer('realnominal')->nullable();
            $table->string('realjenis', 50)->nullable();
            $table->string('jenis', 50);
            $table->string('keterangan');
            $table->string('marking', 200);
            $table->string('bendahara')->nullable();
            $table->date('tglkwitansi')->nullable();
            $table->integer('id_sekolah');
            $table->string('created_by', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_keuangan');
    }
};
