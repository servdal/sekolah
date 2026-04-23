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
        Schema::connection('simaster')->create('db_kkm', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('kelas', 5);
            $table->string('matpel', 150);
            $table->string('muatan', 50);
            $table->string('jenis', 10)->default('wajib');
            $table->integer('kitiga');
            $table->integer('kiempat');
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
        Schema::connection('simaster')->dropIfExists('db_kkm');
    }
};
