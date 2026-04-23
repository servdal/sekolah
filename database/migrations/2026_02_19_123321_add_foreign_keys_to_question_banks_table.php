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
        Schema::connection('simaster')->table('question_banks', function (Blueprint $table) {
            // Ambil nama database utama (duidevco_simadu) dari config
            $dbUtama = config('database.connections.mysql.database');

            $table->foreign('created_by')
                ->references('id')
                ->on($dbUtama . '.users') // Pastikan ada TITIK (.) di sini
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->table('question_banks', function (Blueprint $table) {
            $table->dropForeign('question_banks_created_by_foreign');
        });
    }
};
