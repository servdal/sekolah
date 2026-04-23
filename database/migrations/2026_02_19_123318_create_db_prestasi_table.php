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
        Schema::connection('simaster')->create('db_prestasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('namakegiatan');
            $table->string('bidang', 100);
            $table->string('tingkat', 25);
            $table->string('juara', 50);
            $table->string('penyelenggara', 100);
            $table->string('tempat', 150);
            $table->string('tanggal', 50);
            $table->string('tapel', 15);
            $table->string('nama', 150);
            $table->string('noinduk', 25);
            $table->string('kelas', 15);
            $table->string('namafile', 150)->nullable();
            $table->string('inputor', 100);
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
        Schema::connection('simaster')->dropIfExists('db_prestasi');
    }
};
