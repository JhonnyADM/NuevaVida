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
        Schema::create('tratamiento', function (Blueprint $table) {
            $table->id();
            $table->string('detalles');
            $table->date('fecha');

            // Llave foránea a tipo_tratamiento
            $table->foreignId('tipo_tratamiento_id')->constrained('tipo_tratamiento')->onDelete('cascade');

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
        Schema::dropIfExists('tratamiento');
    }
};
