<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();

            // Nilai mata pelajaran dipisah
            $table->decimal('nilai_matematika', 5, 2);
            $table->decimal('nilai_bahasa_indonesia', 5, 2);
            $table->decimal('nilai_bahasa_inggris', 5, 2);
            $table->decimal('nilai_ipa', 5, 2);
            $table->decimal('nilai_ips', 5, 2);
            $table->decimal('nilai_fisika', 5, 2);
            $table->decimal('nilai_biologi', 5, 2);
            $table->decimal('nilai_ppkn', 5, 2);

            $table->tinyInteger('skor_minat_bakat');
            $table->decimal('tinggi_badan', 6, 2);
            $table->decimal('berat_badan', 6, 2);
            $table->boolean('buta_warna');

            $table->foreignId('minat_jurusan_1_id')->nullable()->constrained('jurusan');
            $table->foreignId('minat_jurusan_2_id')->nullable()->constrained('jurusan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tes');
    }
};