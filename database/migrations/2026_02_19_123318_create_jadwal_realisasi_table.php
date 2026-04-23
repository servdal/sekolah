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
        Schema::connection('simaster')->create('jadwal_realisasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('tanggal')->nullable();
            $table->timestamp('mulai')->nullable();
            $table->timestamp('akhir')->nullable();
            $table->time('jammulai')->nullable();
            $table->time('jamakhir')->nullable();
            $table->string('hari', 5);
            $table->string('ruang', 100);
            $table->integer('idmatpel');
            $table->string('matapelajaran', 200);
            $table->string('kelas', 8);
            $table->integer('semester');
            $table->string('tapel', 10);
            $table->string('marking', 50);
            $table->string('guruterjadwal')->nullable();
            $table->string('niyguru', 25)->nullable();
            $table->text('materi')->nullable();
            $table->date('tglkehadiran')->nullable();
            $table->string('guruyanghadir')->nullable();
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
        Schema::connection('simaster')->dropIfExists('jadwal_realisasi');
    }
};
