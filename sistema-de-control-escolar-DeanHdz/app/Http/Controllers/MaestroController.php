<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\User;
use App\Models\Calificacion;

class MaestroController extends Controller
{
    public function index()
    {
        //Al iniciar la pagina de maestro realiza todas las peticiones de las siguientes tablas
        
        $maestro = User::where('id', auth()->user()->id)->first(); //Maestro dependiendo del id del usuario
        $grupos = Grupo::where('maestro_id', auth()->user()->id)->get(); //Grupos dependiendo del id del Maeestro

        return view('maestro', compact('maestro','grupos'));
    }

    public function eliminarCalificaciones(){
        //Elimina todas las calificaciones de los alumnos en un grupo
        $calificaciones = Calificacion::where('grupo_id', request('grupo_id'))->get();
        foreach($calificaciones as $calificacion){
            $calificacion->delete();
        }
        return redirect()->back();
    }
}
