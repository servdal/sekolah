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
        Schema::connection('simaster')->create('mushaf_halaman', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('juz', 9);
            $table->string('namasurah', 25);
            $table->integer('halaman');
            $table->integer('kata');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('mushaf_halaman');
    }
};
