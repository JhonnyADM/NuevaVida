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
        Schema::create('control', function (Blueprint $table) {
            $table->id();
            $table->string('Observacion');
            $table->date('fecha');
            // Llave foránea a tipo_tratamiento
            $table->foreignId('estado_id')->constrained('estado')->onDelete('cascade');
            $table->unsignedBigInteger('tratamiento_id');
            $table->foreign('tratamiento_id')
                ->references('id')
                ->on('tratamiento')
                ->onDelete('cascade'); // ← Esto indica "composición"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control');
    }
};
