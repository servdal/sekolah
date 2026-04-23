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
        Schema::connection('simaster')->create('db_tatib', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('kode', 5)->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('point')->nullable();
            $table->string('kelompok', 150)->nullable();
            $table->text('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_tatib');
    }
};
