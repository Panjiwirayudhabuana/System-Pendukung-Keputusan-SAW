<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jangan gunakan factory, karena model User Anda tidak memakai HasFactory.
        // Fokus seeding sesuai kebutuhan sistem (admin tersedia sejak awal).

        $this->call([
            // Kalau Anda punya RoleSeeder, taruh di sini duluan:
            // RoleSeeder::class,

            AdminSeeder::class,
            SoalMinatSeeder::class,
            JurusanSeeder::class,
            GuruBKSeeder::class,
            KriteriaSeeder::class,
            JurusanKriteriaSeeder::class,
        ]);
    }
}
