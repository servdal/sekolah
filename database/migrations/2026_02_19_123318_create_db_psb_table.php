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
        Schema::connection('simaster')->create('db_psb', function (Blueprint $table) {
            $table->integer('id', true);
            $table->year('tahun');
            $table->string('kodependaf', 25);
            $table->string('kodepsb', 20);
            $table->string('nama');
            $table->string('nik', 30);
            $table->string('kelamin', 2);
            $table->string('tmplahir', 150);
            $table->string('tgllahir', 20);
            $table->string('umur', 25);
            $table->string('darah', 5);
            $table->string('berat', 5);
            $table->string('tinggi', 5);
            $table->string('alamatortu');
            $table->string('namaayah');
            $table->string('namaibu');
            $table->string('kerjaayah', 150);
            $table->string('kerjaibu', 150);
            $table->string('wali');
            $table->string('pekerjaanwali', 150);
            $table->string('foto', 150);
            $table->string('tamasuk', 50);
            $table->string('hape', 50);
            $table->string('asal', 150);
            $table->string('mutasi', 150);
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->string('kota', 150);
            $table->string('kodepos', 10);
            $table->string('telpon', 50);
            $table->string('erte', 5);
            $table->string('erwe', 5);
            $table->string('n1', 5);
            $table->string('n2', 5);
            $table->string('n3', 5);
            $table->string('n4', 5);
            $table->string('n5', 5);
            $table->string('n6', 5);
            $table->string('n7', 5);
            $table->string('n8', 5);
            $table->string('n9', 5);
            $table->string('n10', 5);
            $table->string('n11', 5);
            $table->string('n12', 5);
            $table->string('n13', 5);
            $table->string('total', 5);
            $table->string('rata', 5);
            $table->string('hasil', 50);
            $table->string('deadline', 50);
            $table->string('akhirumum', 50);
            $table->string('nosurat', 50);
            $table->mediumText('des1');
            $table->mediumText('des2');
            $table->mediumText('des3');
            $table->mediumText('des4');
            $table->mediumText('des5');
            $table->mediumText('des6');
            $table->mediumText('des7');
            $table->mediumText('des8');
            $table->string('dana1', 15);
            $table->string('dana2', 15);
            $table->string('dana3', 15);
            $table->string('dana4', 15);
            $table->string('status', 20);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->integer('id_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_psb');
    }
};
