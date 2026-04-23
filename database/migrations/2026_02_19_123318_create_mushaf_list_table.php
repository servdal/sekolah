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
        Schema::connection('simaster')->create('mushaf_list', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('surah', 50);
            $table->string('makna', 50);
            $table->integer('jumlah');
            $table->string('jenis', 15);
            $table->integer('cek');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('mushaf_list');
    }
};
