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
        Schema::create('tes_pdf', function (Blueprint $table) {
        $table->foreignId('tes_id')->primary()->constrained('tes')->cascadeOnDelete();
        $table->foreignId('upload_id')->constrained('uploads');
        $table->dateTime('generated_at');
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tes_pdf');
    }
};
