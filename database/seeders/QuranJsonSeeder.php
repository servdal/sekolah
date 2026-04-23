<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuranJsonSeeder extends Seeder
{
    private const TARGET_CONNECTION = 'simaster';

    /**
     * File name => target table.
     *
     * @var array<string, string>
     */
    private array $maps = [
        'merged_aya.json' => 'mushaf',
    ];

    public function run(): void
    {
        DB::connection(self::TARGET_CONNECTION)->statement("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
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
            $this->command?->warn("Skip {$table}: table tidak ditemukan di koneksi simaster.");
            return;
        }

        $path = __DIR__ . '/data/quran/' . $file;
        if (!is_file($path)) {
            $this->command?->warn("Skip {$table}: file {$file} tidak ditemukan.");
            return;
        }

        $json = file_get_contents($path);
        $rows = json_decode((string) $json, true);
        if (!is_array($rows) || empty($rows)) {
            $this->command?->warn("Skip {$table}: data kosong.");
            return;
        }

        $normalizedRows = $rows;
        if ($table === 'mushaf') {
            $normalizedRows = array_map(fn (array $row): array => $this->normalizeMushafRow($row), $rows);
        }

        DB::connection(self::TARGET_CONNECTION)->table($table)->truncate();
        foreach (array_chunk($normalizedRows, 500) as $chunk) {
            DB::connection(self::TARGET_CONNECTION)->table($table)->insert($chunk);
        }

        $this->command?->info("Seed {$table}: " . count($normalizedRows) . ' rows');
    }

    private function normalizeMushafRow(array $row): array
    {
        $intFields = ['aya_id', 'aya_number', 'sura_id', 'juz_id', 'page_number', 'sajda', 'manzil'];
        foreach ($intFields as $field) {
            if (array_key_exists($field, $row)) {
                $row[$field] = ($row[$field] === '' || $row[$field] === null) ? null : (int) $row[$field];
            }
        }

        if (array_key_exists('arabic_words', $row)) {
            $value = $row['arabic_words'];
            if (is_array($value)) {
                $row['arabic_words'] = json_encode($value, JSON_UNESCAPED_UNICODE);
            } elseif (is_string($value) && trim($value) !== '') {
                $decoded = json_decode($value, true);
                $row['arabic_words'] = json_last_error() === JSON_ERROR_NONE
                    ? json_encode($decoded, JSON_UNESCAPED_UNICODE)
                    : null;
            } else {
                $row['arabic_words'] = null;
            }
        }

        if (array_key_exists('updated_at', $row)) {
            $row['updated_at'] = (is_string($row['updated_at']) && trim($row['updated_at']) !== '')
                ? $row['updated_at']
                : null;
        }

        return $row;
    }
}
