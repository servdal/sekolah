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
        Schema::connection('simaster')->create('db_tesppdb', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('hari', 10);
            $table->string('jam', 25);
            $table->string('materi', 100);
            $table->string('nama', 50);
            $table->date('tanggal');
            $table->string('ruang', 25);
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
        Schema::connection('simaster')->dropIfExists('db_tesppdb');
    }
};
