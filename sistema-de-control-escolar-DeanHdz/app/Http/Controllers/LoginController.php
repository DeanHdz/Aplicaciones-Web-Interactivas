<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; //Utilizar cifrado de hash

class LoginController extends Controller
{
    public function verifyLogin()
    {
        $credentials = request()->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if($user){
            if(Hash::check($credentials['password'], $user->password)){
                auth()->login($user);
                return redirect()->route('maestro');
            }
        }

        return redirect()->route('login');
    }
}
