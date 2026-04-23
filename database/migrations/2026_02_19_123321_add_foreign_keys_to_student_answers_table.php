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
        Schema::connection('simaster')->table('student_answers', function (Blueprint $table) {
            $table->foreign(['exam_id'])->references(['id'])->on('exams')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['question_bank_id'])->references(['id'])->on('question_banks')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->table('student_answers', function (Blueprint $table) {
            $table->dropForeign('student_answers_exam_id_foreign');
            $table->dropForeign('student_answers_question_bank_id_foreign');
        });
    }
};
