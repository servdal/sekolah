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
        Schema::connection('simaster')->create('exam_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('exam_id');
            $table->integer('student_id');
            $table->string('noinduk', 20);
            $table->string('nama');
            $table->string('kelas', 10);
            $table->decimal('total_nilai', 6);
            $table->decimal('nilai_pg', 6)->nullable();
            $table->decimal('nilai_esai', 6)->nullable();
            $table->enum('status', ['lulus', 'tidak_lulus'])->nullable();
            $table->timestamps();

            $table->unique(['exam_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('exam_results');
    }
};
