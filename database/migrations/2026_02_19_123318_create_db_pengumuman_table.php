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
        Schema::connection('simaster')->create('db_pengumuman', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('jenis', 30);
            $table->string('siapa');
            $table->string('nim', 20);
            $table->text('pengumuman');
            $table->string('tanggal', 20);
            $table->timestamp('kapan')->useCurrent();
            $table->integer('id_sekolah');
            $table->string('fakultas', 50)->nullable();
            $table->longText('gambar')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_pengumuman');
    }
};
