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
        Schema::connection('simaster')->create('db_loginputnilai', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('niy', 50);
            $table->date('tanggal');
            $table->integer('tema');
            $table->integer('subtema');
            $table->string('matpel', 50);
            $table->string('kodekd', 10);
            $table->string('kelas', 10);
            $table->string('tapel', 20);
            $table->string('jennilai', 20);
            $table->integer('semester');
            $table->string('marking');
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
        Schema::connection('simaster')->dropIfExists('db_loginputnilai');
    }
};
