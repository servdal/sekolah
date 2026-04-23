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
        Schema::connection('simaster')->create('tbl_suratkeluar', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('marking', 250);
            $table->string('jenissrt', 150);
            $table->integer('nomor');
            $table->date('tglsurat');
            $table->string('daysrt', 3);
            $table->string('monsrt', 3);
            $table->year('yersrt');
            $table->string('kepada', 150)->nullable();
            $table->string('alamat', 150)->nullable();
            $table->text('perihal');
            $table->string('idpejabat', 50)->nullable();
            $table->string('pejabat', 150)->nullable();
            $table->string('namapejabat', 150)->nullable();
            $table->text('sifat');
            $table->string('klasifikasi', 250);
            $table->string('pembuat');
            $table->text('status');
            $table->string('ruangarsip', 50);
            $table->string('ordnerarsip', 50);
            $table->text('lemariarsip');
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
        Schema::connection('simaster')->dropIfExists('tbl_suratkeluar');
    }
};
