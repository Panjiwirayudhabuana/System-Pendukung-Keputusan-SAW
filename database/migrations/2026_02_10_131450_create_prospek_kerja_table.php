<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prospek_kerja', function (Blueprint $table) {
        $table->id();
        $table->foreignId('jurusan_id')->constrained('jurusan');
        $table->enum('tipe', ['umum', 'alumni']);
        $table->text('isi');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospek_kerja');
    }
};
