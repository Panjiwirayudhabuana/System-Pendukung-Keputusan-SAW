<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanKriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $kriteria = DB::table('kriteria')->pluck('id', 'kode_kriteria');
        $jurusan  = DB::table('jurusan')->pluck('id', 'nama_jurusan');

        // Optional: biar aman kalau seeder dijalankan ulang
        DB::table('jurusan_kriteria')->delete();

        $bobotPerJurusan = [

            'Teknik Alat Berat' => [
                'C1' => 0.14, 'C2' => 0.05, 'C3' => 0.04, 'C4' => 0.10,
                'C5' => 0.03, 'C6' => 0.14, 'C7' => 0.03, 'C8' => 0.02,
                'C9' => 0.20, 'C10' => 0.12, 'C11' => 0.08, 'C12' => 0.05,
            ],

            'Teknik Kendaraan Ringan (Otomotif)' => [
                'C1' => 0.14, 'C2' => 0.05, 'C3' => 0.04, 'C4' => 0.10,
                'C5' => 0.03, 'C6' => 0.14, 'C7' => 0.03, 'C8' => 0.02,
                'C9' => 0.20, 'C10' => 0.12, 'C11' => 0.08, 'C12' => 0.05,
            ],

            'Teknik Sepeda Motor' => [
                'C1' => 0.14, 'C2' => 0.05, 'C3' => 0.04, 'C4' => 0.10,
                'C5' => 0.03, 'C6' => 0.14, 'C7' => 0.03, 'C8' => 0.02,
                'C9' => 0.20, 'C10' => 0.12, 'C11' => 0.08, 'C12' => 0.05,
            ],

            'Teknik Pemesinan' => [
                'C1' => 0.14, 'C2' => 0.05, 'C3' => 0.04, 'C4' => 0.10,
                'C5' => 0.03, 'C6' => 0.14, 'C7' => 0.03, 'C8' => 0.02,
                'C9' => 0.20, 'C10' => 0.12, 'C11' => 0.08, 'C12' => 0.05,
            ],

            'Teknik Mekatronika' => [
                'C1' => 0.15, 'C2' => 0.04, 'C3' => 0.05, 'C4' => 0.10,
                'C5' => 0.02, 'C6' => 0.15, 'C7' => 0.02, 'C8' => 0.02,
                'C9' => 0.20, 'C10' => 0.08, 'C11' => 0.05, 'C12' => 0.12,
            ],

            'Teknik Konstruksi & Perumahan' => [
                'C1' => 0.13, 'C2' => 0.06, 'C3' => 0.04, 'C4' => 0.08,
                'C5' => 0.04, 'C6' => 0.12, 'C7' => 0.03, 'C8' => 0.03,
                'C9' => 0.18, 'C10' => 0.14, 'C11' => 0.08, 'C12' => 0.07,
            ],

            'Desain Pemodelan & Informasi Bangunan (DPIB)' => [
                'C1' => 0.14, 'C2' => 0.07, 'C3' => 0.05, 'C4' => 0.08,
                'C5' => 0.05, 'C6' => 0.10, 'C7' => 0.02, 'C8' => 0.03,
                'C9' => 0.22, 'C10' => 0.08, 'C11' => 0.04, 'C12' => 0.12,
            ],

            'Teknik Instalasi Listrik' => [
                'C1' => 0.14, 'C2' => 0.04, 'C3' => 0.05, 'C4' => 0.10,
                'C5' => 0.02, 'C6' => 0.14, 'C7' => 0.02, 'C8' => 0.02,
                'C9' => 0.18, 'C10' => 0.08, 'C11' => 0.04, 'C12' => 0.17,
            ],

            'Teknik Pembangkit Tenaga Listrik' => [
                'C1' => 0.14, 'C2' => 0.04, 'C3' => 0.05, 'C4' => 0.10,
                'C5' => 0.02, 'C6' => 0.14, 'C7' => 0.02, 'C8' => 0.02,
                'C9' => 0.18, 'C10' => 0.08, 'C11' => 0.04, 'C12' => 0.17,
            ],

            'Teknik Audio Video' => [
                'C1' => 0.12, 'C2' => 0.05, 'C3' => 0.08, 'C4' => 0.08,
                'C5' => 0.03, 'C6' => 0.10, 'C7' => 0.02, 'C8' => 0.02,
                'C9' => 0.24, 'C10' => 0.05, 'C11' => 0.03, 'C12' => 0.18,
            ],

            'Teknik Komputer & Jaringan (TKJ)' => [
                'C1' => 0.13, 'C2' => 0.06, 'C3' => 0.09, 'C4' => 0.07,
                'C5' => 0.03, 'C6' => 0.08, 'C7' => 0.02, 'C8' => 0.02,
                'C9' => 0.28, 'C10' => 0.03, 'C11' => 0.02, 'C12' => 0.17,
            ],

            'Desain Komunikasi Visual (DKV)' => [
                'C1' => 0.06, 'C2' => 0.10, 'C3' => 0.08, 'C4' => 0.03,
                'C5' => 0.05, 'C6' => 0.02, 'C7' => 0.02, 'C8' => 0.04,
                'C9' => 0.38, 'C10' => 0.02, 'C11' => 0.02, 'C12' => 0.18,
            ],
        ];

        $aturanKhusus = [
            'Teknik Instalasi Listrik' => [
                'C12' => [
                    'wajib_lolos' => true,
                    'keterangan' => 'Tidak buta warna',
                ],
            ],
            'Teknik Pembangkit Tenaga Listrik' => [
                'C12' => [
                    'wajib_lolos' => true,
                    'keterangan' => 'Tidak buta warna',
                ],
            ],
            'Teknik Audio Video' => [
                'C12' => [
                    'wajib_lolos' => true,
                    'keterangan' => 'Tidak buta warna',
                ],
            ],
            'Desain Komunikasi Visual (DKV)' => [
                'C12' => [
                    'wajib_lolos' => true,
                    'keterangan' => 'Tidak buta warna',
                ],
            ],
        ];

        $insertData = [];

        foreach ($bobotPerJurusan as $namaJurusan => $bobotKriteria) {
            if (!isset($jurusan[$namaJurusan])) {
                continue;
            }

            foreach ($bobotKriteria as $kodeKriteria => $bobot) {
                if (!isset($kriteria[$kodeKriteria])) {
                    continue;
                }

                $aturan = $aturanKhusus[$namaJurusan][$kodeKriteria] ?? [];

                $insertData[] = [
                    'jurusan_id'   => $jurusan[$namaJurusan],
                    'kriteria_id'  => $kriteria[$kodeKriteria],
                    'bobot'        => $bobot,
                    'nilai_min'    => $aturan['nilai_min'] ?? null,
                    'nilai_max'    => $aturan['nilai_max'] ?? null,
                    'wajib_lolos'  => $aturan['wajib_lolos'] ?? false,
                    'keterangan'   => $aturan['keterangan'] ?? null,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ];
            }
        }

        DB::table('jurusan_kriteria')->insert($insertData);
    }
}