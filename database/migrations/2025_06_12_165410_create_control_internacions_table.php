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
        Schema::create('control_internacion', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->dateTime('fecha'); 
            $table->foreignId('estado_id')->constrained('estado')->onDelete('cascade');
            $table->unsignedBigInteger('internacion_id');
            $table->foreign('internacion_id')
                ->references('id')
                ->on('internacion')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_internacion');
    }
};
