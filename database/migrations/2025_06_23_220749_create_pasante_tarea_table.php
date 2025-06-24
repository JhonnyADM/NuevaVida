<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('pasante_tarea', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pasante_id')->constrained('pasante')->onDelete('cascade');
        $table->foreignId('tarea_id')->constrained('tarea')->onDelete('cascade');
        $table->timestamp('asignado_en')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasante_tarea');
    }
};
