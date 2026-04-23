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
        Schema::connection('simaster')->create('db_tagihanmanual', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idsiswa');
            $table->string('jenis', 25)->nullable();
            $table->integer('biaya')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tenggat')->nullable();
            $table->string('marking', 200)->nullable();
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
        Schema::connection('simaster')->dropIfExists('db_tagihanmanual');
    }
};
