<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function endSesion()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
