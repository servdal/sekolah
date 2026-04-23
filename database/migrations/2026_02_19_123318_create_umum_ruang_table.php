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
        Schema::connection('simaster')->create('umum_ruang', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('namarg', 32);
            $table->string('namagd', 32);
            $table->string('kodegd', 8);
            $table->string('koderg', 35);
            $table->string('petugas', 150);
            $table->string('marking', 200);
            $table->string('kapasitasujian', 5);
            $table->string('luas', 10);
            $table->string('kondisi', 25)->default('Terawat');
            $table->integer('utilitas')->default(40);
            $table->string('pinjam', 100)->default('Tidak di Sewa/Pinjamkan');
            $table->integer('pjgedung')->default(0);
            $table->integer('tarif')->default(0);
            $table->string('inputor', 150);
            $table->string('foto', 150)->nullable();
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
        Schema::connection('simaster')->dropIfExists('umum_ruang');
    }
};
