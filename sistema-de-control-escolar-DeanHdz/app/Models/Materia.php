<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'materia_id'); // 'materia_id' es la llave foranea en la tabla grupos
    }
}
