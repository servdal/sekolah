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
        Schema::connection('simaster')->create('db_beasiswa', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('noinduk', 20)->nullable();
            $table->string('nama')->nullable();
            $table->string('kelas', 5)->nullable();
            $table->string('tapel', 20)->nullable();
            $table->string('jenis', 15)->nullable();
            $table->string('namabeasiswa')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('nominal')->nullable();
            $table->string('inputor')->nullable();
            $table->string('nmfile', 150)->nullable();
            $table->integer('id_sekolah')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_beasiswa');
    }
};
