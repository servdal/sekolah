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
        Schema::connection('simaster')->create('db_nilai', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('noinduk', 20);
            $table->string('nama');
            $table->string('kelas', 10);
            $table->string('tapel', 20);
            $table->string('semester', 10);
            $table->string('tema', 10);
            $table->string('subtema', 10)->nullable();
            $table->string('kodekd', 20);
            $table->text('deskripsi')->nullable();
            $table->string('matpel', 50);
            $table->decimal('nilai', 11);
            $table->integer('nilai01')->nullable();
            $table->integer('nilai02')->nullable();
            $table->integer('nilai03')->nullable();
            $table->integer('nilai04')->nullable();
            $table->integer('nilai05')->nullable();
            $table->integer('nilai06')->nullable();
            $table->integer('kkm')->nullable();
            $table->integer('status')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('id_sekolah')->nullable();
            $table->string('penginput', 50);
            $table->date('tanggal')->nullable();
            $table->timestamp('mulai')->nullable();
            $table->timestamp('akhir')->nullable();
            $table->integer('timer')->nullable();
            $table->string('jennilai', 20);
            $table->string('marking', 100);
            $table->string('keterangan', 50);
            $table->text('surat');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_nilai');
    }
};
