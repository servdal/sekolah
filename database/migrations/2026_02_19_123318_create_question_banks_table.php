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
        Schema::connection('simaster')->create('question_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('created_by')->index('question_banks_created_by_foreign');
            $table->string('mapel');
            $table->string('kelas');
            $table->enum('tipe', ['pg', 'pg_kompleks', 'menjodohkan', 'benar_salah', 'esai']);
            $table->longText('stimulus')->nullable();
            $table->longText('pertanyaan');
            $table->decimal('bobot', 5)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('question_banks');
    }
};
