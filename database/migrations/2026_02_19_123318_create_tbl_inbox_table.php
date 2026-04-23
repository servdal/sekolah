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
        Schema::connection('simaster')->create('tbl_inbox', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('xmarking', 200)->nullable();
            $table->string('tabel', 50)->nullable();
            $table->text('perihal')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('penerima', 50)->nullable();
            $table->string('urlsurat')->nullable();
            $table->string('jenis', 50);
            $table->integer('status')->nullable();
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
        Schema::connection('simaster')->dropIfExists('tbl_inbox');
    }
};
