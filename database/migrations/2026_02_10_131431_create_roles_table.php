<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // WAJIB ada 'id' karena users.role_id constrained ke roles.id
            $table->string('nama_role', 30)->unique();
            $table->timestamps();
        });

        $now = now();

        DB::table('roles')->insert([
            ['nama_role' => 'admin',   'created_at' => $now, 'updated_at' => $now],
            ['nama_role' => 'guru_bk', 'created_at' => $now, 'updated_at' => $now],
            ['nama_role' => 'siswa',   'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
