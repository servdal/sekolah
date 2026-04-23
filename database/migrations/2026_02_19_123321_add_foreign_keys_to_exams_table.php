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
       Schema::connection('simaster')->table('exams', function (Blueprint $table) {
            // 1. Pastikan kolom dibuat sebagai unsignedBigInteger
            $table->unsignedBigInteger('created_by')->change(); // gunakan change jika kolom sudah ada

            // 2. Ambil nama database referensi dari config
            $dbUtama = config('database.connections.mysql.database');

            // 3. Tambahkan foreign key
            $table->foreign('created_by')
                ->references('id')
                ->on($dbUtama . '.users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->table('exams', function (Blueprint $table) {
            $table->dropForeign('exams_created_by_foreign');
        });
    }
};
