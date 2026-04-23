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
        Schema::connection('simaster')->create('db_pembayaran', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama');
            $table->string('noinduk', 25);
            $table->string('kelas', 4);
            $table->string('jenis', 25);
            $table->integer('biaya');
            $table->string('bulan', 35);
            $table->year('tahun');
            $table->string('verifikasi', 50);
            $table->string('marking', 200);
            $table->string('harian', 16);
            $table->string('inputor', 25);
            $table->string('kirim');
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
        Schema::connection('simaster')->dropIfExists('db_pembayaran');
    }
};
