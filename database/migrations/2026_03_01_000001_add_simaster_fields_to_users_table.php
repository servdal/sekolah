<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'previlage')) {
                $table->string('previlage', 100)->nullable()->after('role_id');
            }
            if (!Schema::hasColumn('users', 'klsajar')) {
                $table->string('klsajar', 50)->nullable()->after('previlage');
            }
            if (!Schema::hasColumn('users', 'smt')) {
                $table->string('smt', 20)->nullable()->after('klsajar');
            }
            if (!Schema::hasColumn('users', 'tapel')) {
                $table->string('tapel', 30)->nullable()->after('smt');
            }
            if (!Schema::hasColumn('users', 'semester')) {
                $table->string('semester', 20)->nullable()->after('tapel');
            }
            if (!Schema::hasColumn('users', 'id_sekolah')) {
                $table->unsignedBigInteger('id_sekolah')->nullable()->after('semester');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['previlage', 'klsajar', 'smt', 'tapel', 'semester', 'id_sekolah'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
