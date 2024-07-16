<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Votacion;
use App\Models\Voto;

class AdminController
{

    public function index()
    {
        $votaciones = Votacion::with('candidatos')->get();
        return view('admin', compact('votaciones'));
    }

    public function nuevoVotacion(Request $request){
        $nuevaVotacion = new Votacion();
        $nuevaVotacion->titulo = $request->titulo;
        $nuevaVotacion->save();
        return redirect()->back();
    }

    public function nuevoCandidato(Request $request){
        $nuevoCandidato = new Candidato();
        $nuevoCandidato->nombre = $request->nombre;
        $nuevoCandidato->votacion_id = $request->votacion_id;
        $nuevoCandidato->save();
        return redirect()->back();
    }

}