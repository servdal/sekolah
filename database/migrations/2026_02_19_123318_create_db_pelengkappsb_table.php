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
        Schema::connection('simaster')->create('db_pelengkappsb', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('niksiswa', 30)->nullable();
            $table->string('panggilan', 50)->nullable();
            $table->string('umur', 5)->nullable();
            $table->string('agama', 15)->nullable();
            $table->string('warga', 5)->nullable();
            $table->string('bahasa', 25)->nullable();
            $table->string('penyakit', 50)->nullable();
            $table->integer('anakke')->nullable();
            $table->integer('kandung')->nullable();
            $table->integer('tiri')->nullable();
            $table->integer('angkat')->nullable();
            $table->string('jarak', 5)->nullable();
            $table->string('telpon', 25)->nullable();
            $table->string('bersama', 15)->nullable();
            $table->string('payah', 50)->nullable();
            $table->string('pibu', 50)->nullable();
            $table->string('gayah', 15)->nullable();
            $table->string('gibu', 15)->nullable();
            $table->string('aayah', 50)->nullable();
            $table->string('aaibu', 50)->nullable();
            $table->string('hayah', 35)->nullable();
            $table->string('hibu', 35)->nullable();
            $table->string('agamawali', 25)->nullable();
            $table->string('hwali', 35)->nullable();
            $table->string('kwali', 50)->nullable();
            $table->string('hubwali', 50)->nullable();
            $table->string('adasaudara', 10)->nullable();
            $table->string('hubsaudara', 50)->nullable();
            $table->string('namasaudara')->nullable();
            $table->string('kelassaudara', 15)->nullable();
            $table->string('alamattk', 100)->nullable();
            $table->string('pindahasal', 50)->nullable();
            $table->string('pindahkelas', 5)->nullable();
            $table->string('pindahtgl', 15)->nullable();
            $table->string('pindahkekls', 5)->nullable();
            $table->string('semester1', 10)->nullable();
            $table->string('semester2', 10)->nullable();
            $table->string('semester3', 10)->nullable();
            $table->string('semester4', 10)->nullable();
            $table->string('semester5', 10)->nullable();
            $table->string('kesulitan', 150)->nullable();
            $table->string('anggotarumah', 150)->nullable();
            $table->string('kegiatansendiri', 150)->nullable();
            $table->string('mata', 50)->nullable();
            $table->string('telinga', 50)->nullable();
            $table->string('wajah', 50)->nullable();
            $table->string('gybljr', 50)->nullable();
            $table->string('bakat', 150)->nullable();
            $table->string('sumberinfo', 100)->nullable();
            $table->string('prestasi1', 150)->nullable();
            $table->string('prestasi2', 150)->nullable();
            $table->string('prestasi3', 150)->nullable();
            $table->string('prestasi4', 150)->nullable();
            $table->string('marking', 50)->nullable();
            $table->string('scanakta', 150)->nullable();
            $table->string('scanfoto', 150)->nullable();
            $table->string('scankk', 150)->nullable();
            $table->string('scanket', 150)->nullable();
            $table->string('scanbukti', 150)->nullable();
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
        Schema::connection('simaster')->dropIfExists('db_pelengkappsb');
    }
};
