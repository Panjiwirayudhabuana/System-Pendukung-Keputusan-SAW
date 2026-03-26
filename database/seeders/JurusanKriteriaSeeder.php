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

        $bobotPerJurusan = [

            'Teknik Alat Berat' => [
                'C1' => 0.22, // Matematika
                'C2' => 0.05, // Bahasa Indonesia
                'C3' => 0.20, // IPA
                'C4' => 0.03, // Bahasa Inggris
                'C5' => 0.20, // Fisik
                'C6' => 0.10, // Buta warna
                'C7' => 0.20, // Minat bakat
            ],

            'Teknik Kendaraan Ringan (Otomotif)' => [
                'C1' => 0.20,
                'C2' => 0.05,
                'C3' => 0.18,
                'C4' => 0.03,
                'C5' => 0.20,
                'C6' => 0.12,
                'C7' => 0.22,
            ],

            'Teknik Sepeda Motor' => [
                'C1' => 0.18,
                'C2' => 0.05,
                'C3' => 0.17,
                'C4' => 0.03,
                'C5' => 0.20,
                'C6' => 0.12,
                'C7' => 0.25,
            ],

            'Teknik Pemesinan' => [
                'C1' => 0.24,
                'C2' => 0.04,
                'C3' => 0.20,
                'C4' => 0.03,
                'C5' => 0.20,
                'C6' => 0.09,
                'C7' => 0.20,
            ],

            'Teknik Mekatronika' => [
                'C1' => 0.22,
                'C2' => 0.04,
                'C3' => 0.20,
                'C4' => 0.07,
                'C5' => 0.15,
                'C6' => 0.12,
                'C7' => 0.20,
            ],

            'Teknik Konstruksi & Perumahan' => [
                'C1' => 0.20,
                'C2' => 0.07,
                'C3' => 0.12,
                'C4' => 0.04,
                'C5' => 0.22,
                'C6' => 0.10,
                'C7' => 0.25,
            ],

            'Desain Pemodelan & Informasi Bangunan (DPIB)' => [
                'C1' => 0.19,
                'C2' => 0.09,
                'C3' => 0.11,
                'C4' => 0.05,
                'C5' => 0.18,
                'C6' => 0.08,
                'C7' => 0.30,
            ],

            'Teknik Instalasi Listrik' => [
                'C1' => 0.22,
                'C2' => 0.04,
                'C3' => 0.18,
                'C4' => 0.06,
                'C5' => 0.14,
                'C6' => 0.16,
                'C7' => 0.20,
            ],

            'Teknik Pembangkit Tenaga Listrik' => [
                'C1' => 0.22,
                'C2' => 0.04,
                'C3' => 0.19,
                'C4' => 0.06,
                'C5' => 0.14,
                'C6' => 0.16,
                'C7' => 0.19,
            ],

            'Teknik Audio Video' => [
                'C1' => 0.16,
                'C2' => 0.05,
                'C3' => 0.14,
                'C4' => 0.10,
                'C5' => 0.10,
                'C6' => 0.20,
                'C7' => 0.25,
            ],

            'Teknik Komputer & Jaringan (TKJ)' => [
                'C1' => 0.20,
                'C2' => 0.07,
                'C3' => 0.10,
                'C4' => 0.13,
                'C5' => 0.05,
                'C6' => 0.10,
                'C7' => 0.35,
            ],

            'Desain Komunikasi Visual (DKV)' => [
                'C1' => 0.07,
                'C2' => 0.16,
                'C3' => 0.05,
                'C4' => 0.12,
                'C5' => 0.05,
                'C6' => 0.10,
                'C7' => 0.45,
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

                $insertData[] = [
                    'jurusan_id'  => $jurusan[$namaJurusan],
                    'kriteria_id' => $kriteria[$kodeKriteria],
                    'bobot'       => $bobot,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }
        }

        DB::table('jurusan_kriteria')->upsert(
            $insertData,
            ['jurusan_id', 'kriteria_id'],
            ['bobot', 'updated_at']
        );
    }
}