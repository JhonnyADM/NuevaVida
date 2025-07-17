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
        Schema::create('promocion_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promocion_id');
            $table->unsignedBigInteger('servicio_id');
            $table->timestamps();

            $table->foreign('promocion_id')->references('id')->on('promocion')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocion_servicio');
    }
};
