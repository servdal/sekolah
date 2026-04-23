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
        Schema::connection('simaster')->create('db_konselinggguru', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('niy', 25);
            $table->string('nama', 150);
            $table->text('deskripsi')->nullable();
            $table->date('tglmasalah');
            $table->string('jenis', 10)->nullable();
            $table->string('kategori', 15)->nullable();
            $table->date('tglpenanganan')->nullable();
            $table->text('layanan')->nullable();
            $table->text('tindaklanjut')->nullable();
            $table->string('hasil', 50)->nullable();
            $table->string('pembimbing', 150);
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
        Schema::connection('simaster')->dropIfExists('db_konselinggguru');
    }
};
