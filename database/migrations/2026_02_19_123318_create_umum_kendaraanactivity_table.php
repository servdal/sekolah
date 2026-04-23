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
        Schema::connection('simaster')->create('umum_kendaraanactivity', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idkendaraan')->nullable();
            $table->string('merek', 150)->nullable();
            $table->string('garasi', 100)->nullable();
            $table->string('driver', 200)->nullable();
            $table->string('nopol', 50)->nullable();
            $table->string('jenis', 15)->nullable();
            $table->date('tanggal')->nullable();
            $table->decimal('nominal', 11)->nullable();
            $table->string('keterangan', 250)->nullable();
            $table->string('inputor', 150)->nullable();
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
        Schema::connection('simaster')->dropIfExists('umum_kendaraanactivity');
    }
};
