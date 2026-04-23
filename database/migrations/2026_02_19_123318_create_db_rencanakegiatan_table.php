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
        Schema::connection('simaster')->create('db_rencanakegiatan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->year('tahun');
            $table->string('perkiraanpelaksanaan', 150);
            $table->string('namakegiatan');
            $table->text('deskripsi');
            $table->integer('pengajuan');
            $table->text('catatanks')->nullable();
            $table->integer('aprovalkeuangan');
            $table->string('bendahara')->nullable();
            $table->text('catatanbendahara')->nullable();
            $table->integer('saldoakhir');
            $table->string('penanggunggjawab');
            $table->string('sekretaris')->nullable();
            $table->string('bendaharakegiatan')->nullable();
            $table->date('mulai')->nullable();
            $table->date('akhir')->nullable();
            $table->string('niypj', 35);
            $table->string('niysekretaris', 35)->nullable();
            $table->string('niybendaharakegiatan', 35)->nullable();
            $table->string('status', 15);
            $table->string('markingteksproposal', 200)->nullable();
            $table->string('markingteksrab', 200)->nullable();
            $table->string('created_by', 35);
            $table->string('marking', 200);
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
        Schema::connection('simaster')->dropIfExists('db_rencanakegiatan');
    }
};
