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
        Schema::create('recibo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atencion_id')->constrained('atencion')->onDelete('cascade');
            $table->foreignId('mascota_id')->constrained('mascota')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('cliente')->onDelete('cascade');
            $table->foreignId('promocion_id')->nullable()->constrained('promocion')->onDelete('set null');
            $table->date('fecha');
            $table->decimal('total', 10, 2)->default(0);
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo');
    }
};
