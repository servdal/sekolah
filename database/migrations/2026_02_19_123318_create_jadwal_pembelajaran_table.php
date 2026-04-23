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
        Schema::connection('simaster')->create('jadwal_pembelajaran', function (Blueprint $table) {
            $table->integer('id', true);
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
            $table->string('k1', 50)->nullable();
            $table->string('k2', 50)->nullable();
            $table->string('k3', 50)->nullable();
            $table->string('k4', 50)->nullable();
            $table->string('k5', 50)->nullable();
            $table->string('k6', 50)->nullable();
            $table->string('k7', 50)->nullable();
            $table->string('k8', 50)->nullable();
            $table->string('k9', 50)->nullable();
            $table->string('k10', 50)->nullable();
            $table->string('k11', 50)->nullable();
            $table->string('k12', 50)->nullable();
            $table->string('k13', 50)->nullable();
            $table->string('k14', 50)->nullable();
            $table->string('k15', 50)->nullable();
            $table->string('k16', 50)->nullable();
            $table->string('k17', 50)->nullable();
            $table->string('k18', 50)->nullable();
            $table->string('k19', 50)->nullable();
            $table->string('k20', 50)->nullable();
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
        Schema::connection('simaster')->dropIfExists('jadwal_pembelajaran');
    }
};
