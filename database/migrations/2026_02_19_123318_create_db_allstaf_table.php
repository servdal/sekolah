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
        Schema::connection('simaster')->create('db_allstaf', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama')->nullable();
            $table->string('ttl', 150)->nullable();
            $table->string('nuptk', 25)->nullable();
            $table->string('niy', 25)->nullable();
            $table->string('kelamin', 3)->nullable();
            $table->string('agama', 15)->nullable();
            $table->string('ijasah', 15)->nullable();
            $table->string('jabatan', 35)->nullable();
            $table->string('statpeg', 25)->nullable();
            $table->string('alamat')->nullable();
            $table->string('notelp', 50)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('klsajar', 5)->nullable();
            $table->string('smt', 3)->nullable();
            $table->string('tapel', 20)->nullable();
            $table->date('tmt')->nullable();
            $table->integer('idfinger')->nullable();
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
        Schema::connection('simaster')->dropIfExists('db_allstaf');
    }
};
