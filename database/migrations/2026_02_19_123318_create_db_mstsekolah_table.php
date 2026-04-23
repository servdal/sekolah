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
        Schema::connection('simaster')->create('db_mstsekolah', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('domain', 50)->nullable();
            $table->string('nama_yayasan');
            $table->integer('level')->nullable()->comment('1:tk,2:sd,3:smp,4:smu');
            $table->string('nama_sekolah');
            $table->string('kode_sekolah', 12);
            $table->string('nis', 60)->nullable();
            $table->string('nss', 60)->nullable();
            $table->string('npsn', 60)->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('telp', 32)->nullable();
            $table->string('email')->nullable();
            $table->integer('id_kepala_sekolah')->nullable();
            $table->string('slogan')->nullable();
            $table->string('akreditasi', 150)->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_grey')->nullable();
            $table->string('frontpage')->nullable();
            $table->string('kopsurat')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('pendaftaran', 15)->nullable();
            $table->mediumText('pengumuman')->nullable();
            $table->string('no_rek', 120)->nullable();
            $table->string('nama_rek')->nullable();
            $table->string('nama_bank_rek')->nullable();
            $table->string('firebaseurl')->nullable();
            $table->string('created_by', 150)->nullable();
            $table->string('updated_by', 150)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_mstsekolah');
    }
};
