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
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->foreignId('role_id')->constrained('roles');
        $table->string('nama', 120);
        $table->string('email', 191)->unique();
        $table->string('password_hash');
        $table->boolean('is_active')->default(true);
        $table->boolean('must_change_password')->default(false);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
