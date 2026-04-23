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
        Schema::connection('simaster')->create('db_presensifinger', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('tanggal')->nullable();
            $table->time('jam1')->nullable();
            $table->time('jam2')->nullable();
            $table->time('jam3')->nullable();
            $table->integer('pin')->nullable();
            $table->string('nip', 25)->nullable();
            $table->string('nama')->nullable();
            $table->string('jabatan', 150)->nullable();
            $table->string('departemen')->nullable();
            $table->string('kantor')->nullable();
            $table->integer('id_sekolah')->nullable();
            $table->string('created_by', 150)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_presensifinger');
    }
};
