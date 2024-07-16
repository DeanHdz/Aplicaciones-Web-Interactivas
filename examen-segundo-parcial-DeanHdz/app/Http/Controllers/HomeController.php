<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Votacion;
use App\Models\Voto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $votaciones = Votacion::with('candidatos')->get(); //Rescatar votaciones con sus candidatos respectivos
        $votosPersonales = Voto::where('user_id', auth()->user()->id)->get(); //Rescatar votos propios del usuario en base a su id
        return view('home', compact('votaciones', 'votosPersonales'));
    }

    public function nuevoVoto(Request $request){
        $nuevoVoto = new Voto();
        $nuevoVoto->user_id = $request->user_id;
        $nuevoVoto->votacion_id = $request->votacion_id;
        $nuevoVoto->candidato_id = $request->candidato_id;
        $nuevoVoto->save();
        return redirect()->back();
    }
}
