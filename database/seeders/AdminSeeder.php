<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Deteksi kolom PK tabel roles: role_id (sesuai ERD) atau id (default migration)
            $rolePk = DB::getSchemaBuilder()->hasColumn('roles', 'role_id') ? 'role_id' : 'id';

            // Karena Anda bilang role admin sudah ada di ID 1
            $adminRoleId = 1;

            // Validasi: pastikan memang ada role admin di ID 1
            $exists = DB::table('roles')
                ->where($rolePk, $adminRoleId)
                ->where('nama_role', 'admin')
                ->exists();

            if (!$exists) {
                // Fallback aman: cari berdasarkan nama_role=admin (kalau ternyata id-nya bukan 1)
                $adminRoleId = DB::table('roles')->where('nama_role', 'admin')->value($rolePk);

                if (!$adminRoleId) {
                    throw new \Exception("Role 'admin' tidak ditemukan di tabel roles.");
                }
            }

            // Kredensial default admin (ubah sesuai kebutuhan Anda)
            $email = 'admin@spksaw.local';
            $plainPassword = 'Admin#12345';

            // Buat/ambil user admin (email unik)
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'role_id' => $adminRoleId,
                    'nama' => 'Administrator',
                    'password_hash' => Hash::make($plainPassword),
                    'is_active' => true,
                    'must_change_password' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Kalau user sudah ada tapi role_id tidak sesuai, selaraskan
            if ((int)$user->role_id !== (int)$adminRoleId) {
                $user->role_id = $adminRoleId;
                $user->save();
            }

            // Pastikan profil admin (tabel admin) ada
            Admin::firstOrCreate([
                'user_id' => $user->getKey(),
            ]);
        });
    }
}
