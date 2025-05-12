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
        Schema::create('veterinario_especialidads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('veterinario_id')->constrained('veterinario')->onDelete('cascade');
            $table->foreignId('especialidad_id')->constrained('especialidads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinario_especialidads');
    }
};
