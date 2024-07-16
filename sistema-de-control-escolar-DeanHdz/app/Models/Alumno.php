<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'alumno_id'); // 'alumno_id' es la llave foranea en la tabla calificaciones
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'alumno_id'); // 'alumno_id' es la llave foranea en la tabla inscripciones
    }
}
