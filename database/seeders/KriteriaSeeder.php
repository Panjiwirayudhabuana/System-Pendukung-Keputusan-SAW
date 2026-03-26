<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // aman jika seeder dijalankan ulang
        DB::table('kriteria')->delete();

        $data = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Matematika',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Bahasa Indonesia',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'IPA',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Bahasa Inggris',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Fisik',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_kriteria' => 'Buta Warna',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_kriteria' => 'Skor Minat Bakat',
                'atribut' => 'benefit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('kriteria')->insert($data);
    }
}