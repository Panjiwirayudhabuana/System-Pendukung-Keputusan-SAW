<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusan_kriteria', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jurusan_id')
                ->constrained('jurusan')
                ->cascadeOnDelete();

            $table->foreignId('kriteria_id')
                ->constrained('kriteria')
                ->cascadeOnDelete();

            // Bobot tiap kriteria untuk jurusan tertentu
            // contoh: 0.1500, 0.1000, 0.2500, dst
            $table->decimal('bobot', 5, 4);
            $table->timestamps();

            // Satu jurusan hanya boleh punya satu bobot untuk satu kriteria
            $table->unique(['jurusan_id', 'kriteria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurusan_kriteria');
    }
};