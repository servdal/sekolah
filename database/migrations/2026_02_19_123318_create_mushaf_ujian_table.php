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
        Schema::connection('simaster')->create('mushaf_ujian', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama')->nullable();
            $table->string('noinduk', 20)->nullable();
            $table->string('kelas', 5)->nullable();
            $table->string('foto', 150)->nullable();
            $table->string('tapel', 10)->nullable();
            $table->integer('semester')->nullable();
            $table->string('tapelsemester', 15)->nullable();
            $table->string('juz', 10)->nullable();
            $table->string('namasurah', 25)->nullable();
            $table->integer('halaman')->nullable();
            $table->integer('jumlahkata')->nullable();
            $table->integer('jumlahkesalahan')->nullable();
            $table->decimal('nilaikesalahan', 11)->nullable();
            $table->decimal('nilaipersurat', 11)->nullable();
            $table->string('predikat', 20)->nullable();
            $table->decimal('nilaiperjuz', 11)->nullable();
            $table->string('niyguru', 25)->nullable();
            $table->string('namaguru')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('ijin')->nullable();
            $table->integer('alpha')->nullable();
            $table->integer('hariefektif')->nullable();
            $table->string('setoransekolah', 25)->nullable();
            $table->string('setoranrumah', 25)->nullable();
            $table->string('namawakaalquran')->nullable();
            $table->string('niywaka', 20)->nullable();
            $table->string('namaks')->nullable();
            $table->string('niyks', 20)->nullable();
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
        Schema::connection('simaster')->dropIfExists('mushaf_ujian');
    }
};
