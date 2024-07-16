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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_id')->constrained('materias', 'id')->onDelete('cascade'); //Para que un grupo exista debe haber una materia
            $table->foreignId('maestro_id')->constrained('users', 'id')->onDelete('cascade'); //Para que un grupo exista debe haber un maestro
            $table->string('nombre'); //El nombre especifica horario y dias de la semana
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};

