<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    use HasFactory;

    public function candidatos()
    {
        return $this->hasMany(Candidato::class, 'votacion_id'); // 'votacion_id' es la llave foranea en la tabla candidatos
    }
}
