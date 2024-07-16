<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Inscripcion;

class AdminController extends Controller
{
    public function index()
    {
        //Al iniciar la pagina de admin realiza todas las peticiones de las siguientes tablas
        $materias = Materia::all();
        $maestros = User::all();
        $alumnos = Alumno::all();
        $grupos = Grupo::all();
        $inscripciones = Inscripcion::all();
        return view('admin', compact('materias', 'maestros', 'alumnos', 'grupos', 'inscripciones'));
    }

    //POSTS
    public function nuevoAlumno(Request $request)
    {
        $nuevoAlumno = new Alumno();
        $nuevoAlumno->nombre = $request->nombre;
        $nuevoAlumno->clave_unica = $request->clave_unica;
        $nuevoAlumno->save();
        return redirect()->back();
    }

    public function nuevoMateria(Request $request)
    {
        $nuevoMateria = new Materia();
        $nuevoMateria->nombre = $request->nombre;
        $nuevoMateria->save();
        return redirect()->back();
    }

    public function nuevoGrupo(Request $request)
    {
        $nuevoGrupo = new Grupo();
        $nuevoGrupo->nombre = $request->nombre;
        $nuevoGrupo->materia_id = $request->materia_id;
        $nuevoGrupo->maestro_id = $request->maestro_id;
        $nuevoGrupo->save();
        return redirect()->back();
    }

    public function nuevoInscripcion(Request $request)
    {
        $nuevoInscripcion = new Inscripcion();
        $nuevoInscripcion->alumno_id = $request->alumno_id;
        $nuevoInscripcion->grupo_id = $request->grupo_id;
        $nuevoInscripcion->save();
        return redirect()->back();
    }

    //DELETES
    public function eliminarAlumno(Request $request)
    {
        $alumno = Alumno::find($request->alumno_id);
        $alumno->delete();
        return redirect()->back();
    }

    public function eliminarMateria(Request $request)
    {
        $materia = Materia::find($request->materia_id);
        $materia->delete();
        return redirect()->back();
    }

    public function eliminarGrupo(Request $request){
        $grupo = Grupo::find($request->grupo_id);
        $grupo->delete();
        return redirect()->back();
    }

    public function eliminarInscripcion(Request $request){
        $inscripcion = Inscripcion::find($request->inscripcion_id);
        $inscripcion->delete();
        return redirect()->back();
    }

    //Los maestros los elimina el admin
    public function eliminarMaestro(Request $request)
    {
        $maestro = User::find($request->maestro_id);
        $maestro->delete();
        return redirect()->back();
    }

}
