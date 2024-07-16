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
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos', 'id')->onDelete('cascade'); //Para que una calificacion exista debe haber un alumno
            $table->foreignId('grupo_id')->constrained('grupos', 'id')->onDelete('cascade'); //Para que una calificacion exista debe haber un grupo
            $table->float('calificacion'); //La calificacion es un numero flotante
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};

