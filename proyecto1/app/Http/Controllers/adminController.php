<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;

class adminController extends Controller{
    

    public function iniciofuncion(){
        $personas = persona::all();
        return view('inicio',['personas' => $personas]);
    }

    public function perrosfuncion(){
        //$personas = persona::all();
        //return view('perros',['personas' => $personas]);
        return view('perros');
    }

    public function nuevaPersona(Request $request){
        //dd($request);
        $nuevaPersona = new persona();
        $nuevaPersona->nombre = $request->nombre;
        $nuevaPersona->direccion = $request->direccion;
        $nuevaPersona->save();
        return redirect()->back(); //"Una vez que termines, te regresas a la vista"
    }
}

?>