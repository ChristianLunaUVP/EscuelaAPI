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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 50);
            $table->string('nombre', 100);
            $table->unsignedBigInteger('carrera_id'); // Definir la columna carrera_id
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('restrict')->onUpdate('cascade'); // Establecer la clave foránea
            $table->integer('semestre');
            $table->string('imagen', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};