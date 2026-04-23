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
        Schema::connection('simaster')->create('app_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('theme', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('route', 100)->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('sequence', 20)->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('is_visible')->nullable();
            $table->string('icon', 200)->nullable();
            $table->string('domainapps', 200)->nullable();
            $table->string('subdomainapps', 200)->nullable();
            $table->string('subsubdomainapps', 200)->nullable();
            $table->string('addressapps', 200)->nullable();
            $table->string('kota', 200)->nullable();
            $table->string('emailapps', 200)->nullable();
            $table->string('logofrontapps', 200)->nullable();
            $table->string('domain', 200)->nullable();
            $table->string('created_by', 20)->nullable();
            $table->string('updated_by', 20)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('app_menu');
    }
};
