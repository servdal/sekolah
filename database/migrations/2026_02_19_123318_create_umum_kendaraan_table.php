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
        Schema::connection('simaster')->create('umum_kendaraan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('merek', 150);
            $table->string('garasi', 100);
            $table->string('kodegarasi', 8);
            $table->string('kodekendaraan', 15);
            $table->string('driver', 150);
            $table->string('marking', 5);
            $table->string('kapasitas', 25);
            $table->string('nopol', 50)->nullable();
            $table->string('pinjam', 50)->nullable();
            $table->string('kondisi', 25)->default('Terawat');
            $table->integer('utilitas')->default(40);
            $table->integer('pjgedung')->nullable();
            $table->string('statpinjam', 150)->nullable();
            $table->integer('tarif')->nullable();
            $table->string('inputor', 150)->nullable();
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
        Schema::connection('simaster')->dropIfExists('umum_kendaraan');
    }
};
