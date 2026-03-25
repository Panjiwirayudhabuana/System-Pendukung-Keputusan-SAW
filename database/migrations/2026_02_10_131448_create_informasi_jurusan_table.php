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
        Schema::create('informasi_jurusan', function (Blueprint $table) {
        $table->foreignId('jurusan_id')->primary()->constrained('jurusan');
        $table->text('fasilitas');
        $table->foreignId('updated_by_user_id')->constrained('users');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_jurusan');
    }
};
