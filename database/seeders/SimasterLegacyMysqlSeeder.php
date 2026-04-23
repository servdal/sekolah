<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SimasterLegacyMysqlSeeder extends Seeder
{
    private const TARGET_CONNECTION = 'simaster';

    /**
     * file json => table target
     *
     * @var array<string, string>
     */
    private array $maps = [
        'app_menu.json' => 'app_menu',
        'db_allstaf.json' => 'db_allstaf',
        'db_datainduk.json' => 'db_datainduk',
        'db_kd.json' => 'db_kd',
        'db_kkm.json' => 'db_kkm',
        'db_komponennilai.json' => 'db_komponennilai',
        'db_layanan.json' => 'db_layanan',
        'db_mstsekolah.json' => 'db_mstsekolah',
        'users.json' => 'users',
    ];

    public function run(): void
    {
        DB::connection(self::TARGET_CONNECTION)->statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            foreach ($this->maps as $file => $table) {
                $this->seedTableFromJson($file, $table);
            }
        } finally {
            DB::connection(self::TARGET_CONNECTION)->statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    private function seedTableFromJson(string $file, string $table): void
    {
        if (!Schema::connection(self::TARGET_CONNECTION)->hasTable($table)) {
            $this->command?->warn("Skip {$table}: tabel target simaster tidak ditemukan.");
            return;
        }

        $path = __DIR__ . '/data/simaster/' . $file;
        if (!is_file($path)) {
            $this->command?->warn("Skip {$table}: file {$file} tidak ditemukan.");
            return;
        }

        $json = file_get_contents($path);
        $rows = json_decode((string) $json, true);
        if (!is_array($rows)) {
            $this->command?->warn("Skip {$table}: format JSON tidak valid.");
            return;
        }

        DB::connection(self::TARGET_CONNECTION)->table($table)->truncate();

        if (empty($rows)) {
            $this->command?->info("Seed {$table}: 0 rows");
            return;
        }

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::connection(self::TARGET_CONNECTION)->table($table)->insert($chunk);
        }

        $this->command?->info("Seed {$table}: " . count($rows) . ' rows');
    }
}
