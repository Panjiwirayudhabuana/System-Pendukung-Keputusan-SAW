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
        Schema::create('uploads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('uploader_user_id')->constrained('users');
        $table->string('file_name');
        $table->enum('ext', ['MP4', 'JPG', 'PDF']);
        $table->string('mime_type', 100);
        $table->decimal('size_mb', 8, 2);
        $table->string('storage_path', 500);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
