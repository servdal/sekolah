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
        Schema::connection('simaster')->create('db_programpip', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idsekolah')->nullable();
            $table->string('datamasuk', 50)->nullable();
            $table->string('nama', 150)->nullable();
            $table->string('kelaslama', 15)->nullable();
            $table->string('kelasbaru', 15)->nullable();
            $table->string('tahap', 15)->nullable();
            $table->string('norek', 150)->nullable();
            $table->string('virtualacc', 150)->nullable();
            $table->string('keterangan', 150)->nullable();
            $table->string('created_by', 150)->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_programpip');
    }
};
