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
        Schema::connection('simaster')->create('db_mutasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama');
            $table->string('noinduk', 10);
            $table->string('nisn', 10);
            $table->string('tapel', 25);
            $table->string('sdtujuan');
            $table->string('alamat');
            $table->string('alasan');
            $table->string('tanggal', 30);
            $table->integer('id_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_mutasi');
    }
};
