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
        Schema::connection('simaster')->create('mushaf', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Follows structure from Seeders/data/quran/merged_aya.json
            $table->integer('aya_id')->primary();
            $table->string('sura_name_en', 150)->nullable();
            $table->string('sura_name_translation_en', 150)->nullable();
            $table->string('revelation_type_en', 50)->nullable();
            $table->integer('aya_number')->nullable();
            $table->text('aya_text')->nullable();
            $table->integer('sura_id')->nullable();
            $table->integer('juz_id')->nullable();
            $table->integer('page_number')->nullable();
            $table->text('translation_aya_text')->nullable();
            $table->longText('tafsir_jalalayn')->nullable();
            $table->longText('tafsir_jalalayn_en')->nullable();
            $table->integer('sajda')->nullable();
            $table->text('transliteration')->nullable();
            $table->text('tajweed_text')->nullable();
            $table->text('aya_text_kemenag')->nullable();
            $table->text('translation_aya_text_kemenag')->nullable();
            $table->text('transliteration_kemenag')->nullable();
            $table->string('sura_name', 150)->nullable();
            $table->string('sura_name_arabic', 150)->nullable();
            $table->string('sura_name_translation', 150)->nullable();
            $table->string('location', 50)->nullable();
            $table->integer('manzil')->nullable();
            $table->text('kitabah')->nullable();
            $table->json('arabic_words')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index(['sura_id', 'aya_number']);
            $table->index(['juz_id', 'page_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('mushaf');
    }
};
