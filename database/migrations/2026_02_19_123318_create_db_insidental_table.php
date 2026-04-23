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
        Schema::connection('simaster')->create('db_insidental', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('deskripsi');
            $table->string('kode', 25);
            $table->integer('biaya');
            $table->string('bataswaktu', 35);
            $table->string('aktifasi', 20);
            $table->string('jenis', 25);
            $table->string('operator', 35);
            $table->timestamp('timestamp')->useCurrentOnUpdate()->useCurrent();
            $table->integer('id_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_insidental');
    }
};
