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
        Schema::create('jawaban_minat', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tes_id')->constrained('tes')->cascadeOnDelete();
        $table->foreignId('soal_minat_id')->constrained('soal_minat')->cascadeOnDelete();
        $table->tinyInteger('skor');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_minat');
    }
};
