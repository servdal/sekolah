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
        Schema::connection('simaster')->create('db_presensi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('tanggal');
            $table->integer('noinduk');
            $table->string('tapel', 25);
            $table->integer('semester')->nullable();
            $table->string('kelas', 10);
            $table->integer('status');
            $table->string('alasan', 150);
            $table->integer('selama');
            $table->longText('surat');
            $table->string('petugas', 150);
            $table->string('marking', 150);
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
        Schema::connection('simaster')->dropIfExists('db_presensi');
    }
};
