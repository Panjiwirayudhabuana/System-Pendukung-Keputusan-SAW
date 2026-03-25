<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruBkSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role_id = 2 (guru_bk)
        $roleId = 2;

        // Insert atau update user guru bk
        DB::table('users')->updateOrInsert(
            ['email' => 'gurubk@spksaw.sch.id'],
            [
                'role_id' => $roleId,
                'nama' => 'Guru BK',
                'password_hash' => Hash::make('password123'),
                'is_active' => true,
                'must_change_password' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Ambil id user yang baru saja dibuat / sudah ada
        $user = DB::table('users')
            ->where('email', 'gurubk@spksaw.sch.id')
            ->first();

        // Insert atau update tabel guru_bk
        DB::table('guru_bk')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'nip' => '198001012020121001',
                'jurusan_id' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $this->command->info('Seeder Guru BK berhasil dijalankan.');
    }
}