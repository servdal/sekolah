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
        Schema::connection('simaster')->create('student_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('question_bank_id')->index('student_answers_question_bank_id_foreign');
            $table->integer('student_id');
            $table->string('noinduk', 20);
            $table->json('jawaban');
            $table->decimal('nilai', 5)->nullable();
            $table->timestamps();

            $table->unique(['exam_id', 'question_bank_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('student_answers');
    }
};
