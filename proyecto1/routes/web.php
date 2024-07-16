<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('iniciourl',[adminController::class, 'iniciofuncion'])->name('inicioruta');
Route::post('nuevapersona',[adminController::class, 'nuevaPersona'])->name('persona.nuevo');

?>