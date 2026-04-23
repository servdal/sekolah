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
        Schema::connection('simaster')->create('bs_ujian', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('ceel', 50)->nullable();
            $table->string('kode', 50)->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamp('mulai')->nullable();
            $table->timestamp('selesai')->nullable();
            $table->string('namaujian', 150)->nullable();
            $table->string('fullkode', 150)->nullable();
            $table->string('supervisor', 150)->nullable();
            $table->string('namapeserta', 150)->nullable();
            $table->string('asalpeserta', 150)->nullable();
            $table->string('nomorpeserta', 150)->nullable();
            $table->integer('idmahasiswa')->nullable();
            $table->integer('idtest')->nullable();
            $table->integer('idsoal')->nullable();
            $table->string('tipe', 25)->nullable();
            $table->integer('urutan')->nullable();
            $table->integer('status')->nullable();
            $table->integer('timer')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('lampiran', 150)->nullable();
            $table->string('lampiran2', 150)->nullable();
            $table->string('lampiran3', 150)->nullable();
            $table->string('lampiran4', 150)->nullable();
            $table->string('lampiran5', 150)->nullable();
            $table->string('lampiran6', 150)->nullable();
            $table->string('tipesoal', 25)->nullable();
            $table->text('opsia')->nullable();
            $table->text('opsib')->nullable();
            $table->text('opsic')->nullable();
            $table->text('opsid')->nullable();
            $table->text('opsie')->nullable();
            $table->text('opsif')->nullable();
            $table->text('opsig')->nullable();
            $table->text('opsih')->nullable();
            $table->text('opsii')->nullable();
            $table->text('opsij')->nullable();
            $table->text('opsik')->nullable();
            $table->text('opsil')->nullable();
            $table->text('opsim')->nullable();
            $table->text('opsin')->nullable();
            $table->text('opsio')->nullable();
            $table->text('opsip')->nullable();
            $table->text('opsiq')->nullable();
            $table->text('opsir')->nullable();
            $table->text('opsis')->nullable();
            $table->text('opsit')->nullable();
            $table->text('kunci')->nullable();
            $table->decimal('skore', 11)->nullable();
            $table->string('marking')->nullable();
            $table->text('jawaban')->nullable();
            $table->text('jawaban2')->nullable();
            $table->text('jawaban3')->nullable();
            $table->text('jawaban4')->nullable();
            $table->text('jawaban5')->nullable();
            $table->text('jawaban6')->nullable();
            $table->text('jawaban7')->nullable();
            $table->text('jawaban8')->nullable();
            $table->text('jawaban9')->nullable();
            $table->text('jawaban10')->nullable();
            $table->text('jawaban11')->nullable();
            $table->text('jawaban12')->nullable();
            $table->text('jawaban13')->nullable();
            $table->text('jawaban14')->nullable();
            $table->text('jawaban15')->nullable();
            $table->text('jawaban16')->nullable();
            $table->text('jawaban17')->nullable();
            $table->text('jawaban18')->nullable();
            $table->text('jawaban19')->nullable();
            $table->text('jawaban20')->nullable();
            $table->integer('pengumuman')->nullable();
            $table->integer('pgskore')->nullable();
            $table->integer('esaiskore')->nullable();
            $table->integer('lisanskore')->nullable();
            $table->integer('bobotpg')->nullable();
            $table->integer('bobotesai')->nullable();
            $table->integer('bobotlisan')->nullable();
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
        Schema::connection('simaster')->dropIfExists('bs_ujian');
    }
};
