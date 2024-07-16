<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //POSTS
    public function verifyRegister(Request $request)
    {
        //Si las contraseñas no coinciden no crear la cuenta
        if($request->password != $request->password_confirmation)
            return redirect()->back();

        $nuevoMaestro = new User();
        $nuevoMaestro->name = $request->name;
        $nuevoMaestro->email = $request->email;
        $nuevoMaestro->password = bcrypt($request->password);
        $nuevoMaestro->save();
        return view('home');
    }
}
