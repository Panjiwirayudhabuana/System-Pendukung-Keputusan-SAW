<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_jurusan' => 'Teknik Alat Berat',                           'is_active' => 1],
            ['nama_jurusan' => 'Teknik Kendaraan Ringan (Otomotif)',           'is_active' => 1],
            ['nama_jurusan' => 'Teknik Sepeda Motor',                          'is_active' => 1],
            ['nama_jurusan' => 'Teknik Pemesinan',                             'is_active' => 1],
            ['nama_jurusan' => 'Teknik Mekatronika',                           'is_active' => 1],
            ['nama_jurusan' => 'Teknik Konstruksi & Perumahan',                'is_active' => 1],
            ['nama_jurusan' => 'Desain Pemodelan & Informasi Bangunan (DPIB)', 'is_active' => 1],
            ['nama_jurusan' => 'Teknik Instalasi Listrik',                     'is_active' => 1],
            ['nama_jurusan' => 'Teknik Pembangkit Tenaga Listrik',             'is_active' => 1],
            ['nama_jurusan' => 'Teknik Audio Video',                           'is_active' => 1],
            ['nama_jurusan' => 'Teknik Komputer & Jaringan (TKJ)',             'is_active' => 1],
            ['nama_jurusan' => 'Desain Komunikasi Visual (DKV)',               'is_active' => 1],
        ];

        // Pastikan tabel sesuai DB fix: 'jurusan'
        // Upsert = insert jika belum ada, update jika sudah ada (berdasarkan nama_jurusan)
        DB::table('jurusan')->upsert(
            $data,
            ['nama_jurusan'],      // key unik untuk cek duplikat
            ['is_active']          // kolom yang di-update bila sudah ada
        );

        $this->command->info('✅ ' . count($data) . ' jurusan berhasil di-seed!');
    }
}
