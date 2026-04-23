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
        Schema::connection('simaster')->create('tbl_suratmasuk', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('marking', 250)->unique('marking');
            $table->integer('noagenda');
            $table->date('tglmasuk');
            $table->date('tglsurat');
            $table->string('daysrt', 3);
            $table->string('monsrt', 3);
            $table->year('yersrt');
            $table->string('jenissurat', 35);
            $table->string('nosurat', 35);
            $table->string('asalsurat', 100);
            $table->string('kepada');
            $table->text('perihal')->nullable();
            $table->string('ringkasan')->nullable();
            $table->string('scansurat', 150);
            $table->string('bentuk', 20);
            $table->string('pembuat', 100);
            $table->string('status', 25);
            $table->string('ruangarsip', 50)->nullable();
            $table->string('ordnerarsip', 50)->nullable();
            $table->string('lemariarsip', 50)->nullable();
            $table->integer('id_sekolah');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('tbl_suratmasuk');
    }
};
