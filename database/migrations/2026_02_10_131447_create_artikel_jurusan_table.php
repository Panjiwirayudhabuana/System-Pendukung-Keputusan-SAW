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
        Schema::create('artikel_jurusan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('jurusan_id')->constrained('jurusan');
        $table->string('judul', 200);
        $table->text('deskripsi');
        $table->foreignId('file_upload_id')->nullable()->constrained('uploads');
        $table->foreignId('gambar_upload_id')->nullable()->constrained('uploads');
        $table->foreignId('created_by_user_id')->constrained('users');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_jurusan');
    }
};
