<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    public function votos()
    {
        return $this->hasMany(Voto::class, 'candidato_id'); // 'candidato_id' es la llave foranea en la tabla votos
    }
}
