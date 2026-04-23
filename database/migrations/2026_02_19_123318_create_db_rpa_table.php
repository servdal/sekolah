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
        Schema::connection('simaster')->create('db_rpa', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('kelas', 20)->nullable();
            $table->integer('pekan')->nullable();
            $table->integer('pb')->nullable();
            $table->year('tahun');
            $table->integer('bulan');
            $table->string('hari', 10);
            $table->integer('tanggal');
            $table->date('realdate');
            $table->integer('hal')->nullable();
            $table->string('murojaahkemarin', 250)->nullable();
            $table->string('mendengaraudio', 250)->nullable();
            $table->string('sholatdhuha', 20)->nullable();
            $table->string('murojaahhariini', 20)->nullable();
            $table->string('tahsin', 20)->nullable();
            $table->string('tilawah', 20)->nullable();
            $table->string('persiapanhafalanbesok', 250)->nullable();
            $table->text('murojaahdirumah')->nullable();
            $table->string('murojaahsabtuahad', 250);
            $table->integer('id_sekolah');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_rpa');
    }
};
