<?php

namespace App\Imports;

use App\Models\Alumno;
use App\Models\Calificacion;
use Maatwebsite\Excel\Concerns\ToCollection;

class CalificacionesImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return Calificacion|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Calificacion::create([
           'alumno_id'     => $row[0],
           'grupo_id'    => $row[1], 
           'calificacion' => $row[2],]);
        }
    }
}