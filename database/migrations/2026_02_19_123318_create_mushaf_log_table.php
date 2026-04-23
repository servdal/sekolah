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
        Schema::connection('simaster')->create('mushaf_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('inputor', 50);
            $table->string('nama', 150);
            $table->string('noinduk', 150);
            $table->string('kelas', 20);
            $table->string('tapel', 20);
            $table->integer('semester');
            $table->integer('jilid');
            $table->date('tanggal');
            $table->string('ziyadah_mulaisurah', 150)->nullable();
            $table->string('ziyadah_mulaiayat', 10)->nullable();
            $table->string('ziyadah_akhirsurah', 150)->nullable();
            $table->string('ziyadah_akhirayat', 10)->nullable();
            $table->string('ziyadah_nilai', 25)->nullable();
            $table->string('ziyadah_predikat', 15)->nullable();
            $table->string('murojaah_mulaisurah', 150)->nullable();
            $table->string('murojaah_mulaiayat', 10)->nullable();
            $table->string('murojaah_akhirsurah', 150)->nullable();
            $table->string('murojaah_akhirayat', 10)->nullable();
            $table->string('murojaah_nilai', 25)->nullable();
            $table->string('murojaah_predikat', 15)->nullable();
            $table->string('tilawah_mulaisurah', 150)->nullable();
            $table->string('tilawah_mulaiayat', 10)->nullable();
            $table->string('tilawah_akhirsurah', 150)->nullable();
            $table->string('tilawah_akhirayat', 10)->nullable();
            $table->string('tilawah_nilai', 25)->nullable();
            $table->string('tilawah_predikat', 15)->nullable();
            $table->text('tahsin')->nullable();
            $table->string('tahsin_nilai', 25)->nullable();
            $table->string('tahsin_predikat', 15)->nullable();
            $table->text('catatan')->nullable();
            $table->string('marking', 150);
            $table->string('keybengakcrash', 150)->nullable()->unique('keybengakcrash');
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
        Schema::connection('simaster')->dropIfExists('mushaf_log');
    }
};
