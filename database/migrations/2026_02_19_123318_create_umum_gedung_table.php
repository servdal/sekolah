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
        Schema::connection('simaster')->create('umum_gedung', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('namagd', 32);
            $table->string('singgd', 12);
            $table->string('kodegd', 8);
            $table->integer('pjgedung')->nullable();
            $table->string('statpinjam', 150)->nullable();
            $table->integer('tarif')->nullable();
            $table->integer('kapasitas')->default(0);
            $table->string('luas', 50)->nullable();
            $table->string('kondisi', 100)->nullable();
            $table->string('inputor', 150)->nullable();
            $table->string('marking', 200);
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
        Schema::connection('simaster')->dropIfExists('umum_gedung');
    }
};
