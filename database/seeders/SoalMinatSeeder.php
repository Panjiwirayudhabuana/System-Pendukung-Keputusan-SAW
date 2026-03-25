<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SoalMinatSeeder extends Seeder
{
    public function run(): void
    {
        $table = 'soal_minat';

        // Pastikan tabel ada
        if (!Schema::hasTable($table)) {
            $this->command?->error("❌ Tabel {$table} tidak ditemukan. Seeder dibatalkan.");
            return;
        }

        // Tentukan nama kolom untuk teks soal (yang benar-benar ada di DB)
        $textColumn = null;
        foreach (['pertanyaan', 'soal', 'teks'] as $col) {
            if (Schema::hasColumn($table, $col)) {
                $textColumn = $col;
                break;
            }
        }

        if (!$textColumn) {
            $this->command?->error("❌ Tidak ditemukan kolom teks soal (pertanyaan/soal/teks) di tabel {$table}.");
            return;
        }

        // Kolom status aktif (kalau ada)
        $hasIsActive = Schema::hasColumn($table, 'is_active');

        // 10 soal yang kamu tulis di blade
        $soalList = [
            'Saya suka memecahkan soal matematika atau logika.',
            'Saya tertarik mempelajari bagaimana teknologi dan komputer bekerja.',
            'Saya senang melakukan eksperimen atau percobaan ilmiah.',
            'Saya mudah memahami konsep-konsep sains dan teknik.',
            'Saya senang berbicara dan berinteraksi dengan banyak orang.',
            'Saya tertarik membantu orang lain memecahkan masalah mereka.',
            'Saya suka menggambar, melukis, atau membuat karya visual.',
            'Saya tertarik pada dunia desain, musik, atau seni.',
            'Saya suka berdagang atau merencanakan bisnis.',
            'Saya senang bernegosiasi dan meyakinkan orang lain.',
        ];

        $inserted = 0;
        $updated  = 0;

        DB::beginTransaction();
        try {
            foreach ($soalList as $txt) {
                // updateOrInsert tanpa model (lebih aman kalau fillable/guarded belum rapi)
                $where = [$textColumn => $txt];

                $data = [];
                if ($hasIsActive) $data['is_active'] = true;

                // kalau record sudah ada -> update is_active; kalau belum -> insert
                $exists = DB::table($table)->where($where)->exists();

                DB::table($table)->updateOrInsert($where, $data);

                if ($exists) $updated++; else $inserted++;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->command?->error("❌ Seeder gagal: " . $e->getMessage());
            return;
        }

        $this->command?->info("✅ SoalMinatSeeder selesai. Inserted: {$inserted}, Updated: {$updated}. Kolom teks: {$textColumn}");
    }
}
