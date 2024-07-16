<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'grupo_id'); // 'grupo_id' es la llave foranea en la tabla inscripciones
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificaion::class, 'grupo_id'); // 'grupo_id' es la llave foranea en la tabla calificaciones
    }
}




