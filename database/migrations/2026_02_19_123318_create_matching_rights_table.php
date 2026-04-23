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
        Schema::connection('simaster')->create('matching_rights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_bank_id')->index('matching_rights_question_bank_id_foreign');
            $table->string('label');
            $table->text('teks');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('matching_rights');
    }
};
