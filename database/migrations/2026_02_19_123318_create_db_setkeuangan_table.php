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
        Schema::connection('simaster')->create('db_setkeuangan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama');
            $table->string('noinduk', 25);
            $table->integer('dpp');
            $table->integer('spp');
            $table->integer('paguyuban');
            $table->string('eksul1', 50)->default('Pramuka');
            $table->string('eksul2', 50);
            $table->string('eksul3', 50);
            $table->string('eksul4', 50);
            $table->string('eksul5', 50);
            $table->integer('id_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_setkeuangan');
    }
};
