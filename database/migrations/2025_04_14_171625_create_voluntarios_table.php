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
        Schema::create('voluntario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_id')->unique(); // Relación uno a uno
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->boolean('estado')->default(true);
            $table->string('direccion');
            $table->unsignedTinyInteger('edad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voluntario');
    }
};
