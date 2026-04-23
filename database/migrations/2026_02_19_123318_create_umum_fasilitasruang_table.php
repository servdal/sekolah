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
        Schema::connection('simaster')->create('umum_fasilitasruang', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idruang');
            $table->string('namabrg', 150);
            $table->string('jenis', 150);
            $table->string('merek', 100);
            $table->string('tahunterima', 15);
            $table->string('jumlah', 25);
            $table->string('sumberdana', 50);
            $table->string('keterangan', 150);
            $table->string('kodebarang', 100);
            $table->string('kondisi', 15);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('umum_fasilitasruang');
    }
};
