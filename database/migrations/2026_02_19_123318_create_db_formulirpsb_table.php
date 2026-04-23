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
        Schema::connection('simaster')->create('db_formulirpsb', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tapel', 15);
            $table->string('nama');
            $table->string('jenis', 15);
            $table->string('nomor', 15);
            $table->string('nominal', 15);
            $table->string('tanggal', 35);
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
        Schema::connection('simaster')->dropIfExists('db_formulirpsb');
    }
};
