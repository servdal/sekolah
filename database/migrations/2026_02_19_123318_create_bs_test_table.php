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
        Schema::connection('simaster')->create('bs_test', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('ceel', 150)->nullable();
            $table->string('kode', 50)->nullable();
            $table->string('tanggal', 50)->nullable();
            $table->string('namaujian')->nullable();
            $table->string('supervisor', 150)->nullable();
            $table->integer('idsupervisor')->nullable();
            $table->string('tipe', 50)->nullable();
            $table->integer('idsoal')->nullable();
            $table->string('fullkode', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('lampiran', 150)->nullable();
            $table->string('lampiran2', 150)->nullable();
            $table->string('lampiran3', 150)->nullable();
            $table->string('lampiran4', 150)->nullable();
            $table->string('lampiran5', 150)->nullable();
            $table->string('lampiran6', 150)->nullable();
            $table->string('tipesoal', 25)->nullable();
            $table->text('opsia')->nullable();
            $table->text('opsib')->nullable();
            $table->text('opsic')->nullable();
            $table->text('opsid')->nullable();
            $table->text('opsie')->nullable();
            $table->text('opsif')->nullable();
            $table->text('opsig')->nullable();
            $table->text('opsih')->nullable();
            $table->text('opsii')->nullable();
            $table->text('opsij')->nullable();
            $table->text('opsik')->nullable();
            $table->text('opsil')->nullable();
            $table->text('opsim')->nullable();
            $table->text('opsin')->nullable();
            $table->text('opsio')->nullable();
            $table->text('opsip')->nullable();
            $table->text('opsiq')->nullable();
            $table->text('opsir')->nullable();
            $table->text('opsis')->nullable();
            $table->text('opsit')->nullable();
            $table->string('kunci', 15)->nullable();
            $table->integer('status')->nullable();
            $table->integer('pengumuman')->nullable();
            $table->timestamp('mulai')->nullable();
            $table->timestamp('selesai')->nullable();
            $table->integer('timer')->nullable();
            $table->string('marking', 100)->nullable();
            $table->integer('id_sekolah');
            $table->string('created_by')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('bs_test');
    }
};
