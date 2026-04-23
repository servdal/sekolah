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
        Schema::connection('simaster')->create('db_kd', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('semester');
            $table->string('kelas', 5);
            $table->string('muatan', 25);
            $table->string('kodekd', 20);
            $table->integer('kkm')->nullable();
            $table->string('deskripsi');
            $table->integer('tema');
            $table->integer('subtema');
            $table->integer('pertemuanke')->nullable();
            $table->text('deskripsitema');
            $table->string('matpel', 250);
            $table->text('materi')->nullable();
            $table->string('template01')->nullable();
            $table->string('template02')->nullable();
            $table->string('template03')->nullable();
            $table->string('template04')->nullable();
            $table->string('template05')->nullable();
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
        Schema::connection('simaster')->dropIfExists('db_kd');
    }
};
