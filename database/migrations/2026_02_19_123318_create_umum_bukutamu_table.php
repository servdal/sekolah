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
        Schema::connection('simaster')->create('umum_bukutamu', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama');
            $table->string('instansi');
            $table->text('keperluan');
            $table->string('hape', 50);
            $table->string('email', 50)->nullable();
            $table->string('pejabat');
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
        Schema::connection('simaster')->dropIfExists('umum_bukutamu');
    }
};
