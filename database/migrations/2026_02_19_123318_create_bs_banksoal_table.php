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
        Schema::connection('simaster')->create('bs_banksoal', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('fullkode', 100)->nullable();
            $table->string('kode', 50)->nullable();
            $table->string('ceel', 150)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('deskripsitambahan')->nullable();
            $table->string('lampiran', 150)->nullable();
            $table->string('lampiran2', 150)->nullable();
            $table->string('lampiran3', 150)->nullable();
            $table->string('lampiran4', 150)->nullable();
            $table->string('lampiran5', 150)->nullable();
            $table->string('lampiran6', 150)->nullable();
            $table->string('jawaban', 25)->nullable();
            $table->text('opsia')->nullable();
            $table->text('opsib')->nullable();
            $table->text('opsic')->nullable();
            $table->text('opsid')->nullable();
            $table->text('opsie')->nullable();
            $table->string('kunci', 15)->nullable();
            $table->integer('active')->nullable();
            $table->text('inputor')->nullable();
            $table->integer('view')->nullable();
            $table->string('nilai01', 50)->nullable();
            $table->string('nilai02', 25)->nullable();
            $table->string('keterangan01', 50)->nullable();
            $table->string('keterangan02', 50)->nullable();
            $table->string('kesimpulan', 50)->nullable();
            $table->string('created_by', 150)->nullable();
            $table->string('verified_by', 150)->nullable();
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
        Schema::connection('simaster')->dropIfExists('bs_banksoal');
    }
};
