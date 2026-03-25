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
        Schema::create('hasil_saw', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tes_id')->constrained('tes')->cascadeOnDelete();
        $table->foreignId('jurusan_id')->constrained('jurusan');
        $table->decimal('nilai_preferensi', 12, 6);
        $table->integer('peringkat');
        $table->timestamps();

        $table->unique(['tes_id', 'jurusan_id']);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_saw');
    }
};
