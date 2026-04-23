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
        Schema::connection('simaster')->create('db_datainduk', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('noinduk', 20);
            $table->string('nik', 25);
            $table->string('nisn', 25);
            $table->string('nama');
            $table->string('kelamin', 2);
            $table->string('tmplahir', 150);
            $table->string('tgllahir', 20);
            $table->string('umur', 10);
            $table->string('darah', 5);
            $table->integer('berat');
            $table->integer('tinggi');
            $table->string('namaayah');
            $table->string('namaibu');
            $table->string('kerjaayah', 150);
            $table->string('kerjaibu', 150);
            $table->string('wali');
            $table->string('pekerjaanwali', 150);
            $table->string('klspos', 5);
            $table->string('foto', 150);
            $table->string('tamasuk', 50);
            $table->string('hape', 50);
            $table->string('asal', 150);
            $table->string('mutasi', 150);
            $table->string('alamatortu');
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->string('kota', 150);
            $table->string('kodepos', 10);
            $table->string('telpon', 50);
            $table->string('erte', 5);
            $table->string('erwe', 5);
            $table->string('jalansaatini')->nullable();
            $table->string('rtsaatini', 5)->nullable();
            $table->string('rwsaatini', 5)->nullable();
            $table->string('desasaatini', 100)->nullable();
            $table->string('kecamatansaatini', 100)->nullable();
            $table->string('kotasaatini', 150)->nullable();
            $table->string('kodepossaatini', 10)->nullable();
            $table->string('panggilan', 50)->nullable();
            $table->string('agama', 15)->nullable();
            $table->string('payah', 50)->nullable();
            $table->string('pibu', 50)->nullable();
            $table->string('gayah', 15)->nullable();
            $table->string('gibu', 15)->nullable();
            $table->string('gybljr', 50)->nullable();
            $table->string('bakat', 150)->nullable();
            $table->string('nokelulusan', 50)->nullable();
            $table->string('melanjutkanke', 150)->nullable();
            $table->string('kodeortu', 50);
            $table->integer('id_sekolah');
            $table->string('jilid', 100)->nullable();
            $table->integer('is_asuh')->nullable();
            $table->string('kodeortuasuh', 100)->nullable();
            $table->string('tglkesediaan', 15)->nullable();
            $table->longText('ttdoratuasuh')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_datainduk');
    }
};
