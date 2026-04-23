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
        Schema::connection('simaster')->create('pesan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->mediumText('pesannya');
            $table->mediumText('ket');
            $table->string('nama');
            $table->string('kelompok', 50);
            $table->string('id_sekolah', 150);
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('pesan');
    }
};
