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
        Schema::connection('simaster')->create('db_komponennilai', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('semester');
            $table->string('kelas', 5);
            $table->string('tapel', 10)->nullable();
            $table->string('matpel', 250);
            $table->string('muatan', 25);
            $table->string('kodekd', 20);
            $table->integer('idkd')->nullable();
            $table->integer('kkm')->nullable();
            $table->string('deskripsi');
            $table->integer('p01')->nullable();
            $table->integer('p02')->nullable();
            $table->integer('p03')->nullable();
            $table->integer('p04')->nullable();
            $table->integer('p05')->nullable();
            $table->integer('e01')->nullable();
            $table->integer('e02')->nullable();
            $table->integer('e03')->nullable();
            $table->integer('e04')->nullable();
            $table->integer('e05')->nullable();
            $table->integer('pts')->nullable();
            $table->integer('pat')->nullable();
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
        Schema::connection('simaster')->dropIfExists('db_komponennilai');
    }
};
