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
        Schema::create('nota_ingreso', function (Blueprint $table) {
            $table->id();
            $table->string('producto_id'); // clave foránea alfanumérica
            $table->unsignedBigInteger('provedor_id'); // clave foránea

            $table->integer('cantidad');
            $table->date('fecha');
            $table->decimal('total', 10, 2);

            $table->timestamps();

            // Claves foráneas
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');
            $table->foreign('provedor_id')->references('id')->on('provedor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ingreso');
    }
};
