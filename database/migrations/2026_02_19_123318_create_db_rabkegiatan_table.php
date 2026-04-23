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
        Schema::connection('simaster')->create('db_rabkegiatan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('deskripsi');
            $table->integer('anggaran');
            $table->integer('disetujui')->nullable();
            $table->string('bendahara', 200)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('marking', 200);
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
        Schema::connection('simaster')->dropIfExists('db_rabkegiatan');
    }
};
