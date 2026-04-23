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
        Schema::connection('simaster')->create('tbl_komplain', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('dari', 150);
            $table->string('hostname', 100);
            $table->string('statuser', 100);
            $table->string('jenis', 50);
            $table->string('nip', 20);
            $table->string('nama');
            $table->string('kepada', 100);
            $table->string('judul', 50);
            $table->text('isikeluhan');
            $table->string('gambar', 150);
            $table->string('extension', 10);
            $table->text('tanggapan');
            $table->string('bukti', 150)->nullable();
            $table->string('jenfile', 15)->nullable();
            $table->string('rating', 25);
            $table->string('status', 50);
            $table->string('marking', 200);
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
        Schema::connection('simaster')->dropIfExists('tbl_komplain');
    }
};
