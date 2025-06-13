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
        Schema::create('internacion', function (Blueprint $table) {
            $table->id();
            $table->string('detalles');
            $table->date('fecha_ingreso');
             $table->date('fecha_salida');
            // Llave foránea a mascota
            $table->foreignId('mascota_id')->constrained('mascota')->onDelete('cascade');
            // Llave foránea a veterinario
            $table->foreignId('veterinario_id')->constrained('veterinario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internacion');
    }
};
