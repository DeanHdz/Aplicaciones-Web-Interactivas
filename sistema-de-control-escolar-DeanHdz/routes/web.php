<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'verifyLogin'])->name('login.post');


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'verifyRegister'])->name('register.post');

Route::get('/endSesion', [VerificationController::class, 'endSesion'])->name('sesion.end');


Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::middleware('guest')->post('/alumnos',[AdminController::class, 'nuevoAlumno'])->name('alumnos.create');
Route::middleware('guest')->delete('/alumnos',[AdminController::class, 'eliminarAlumno'])->name('alumnos.delete');
Route::middleware('guest')->post('/materias',[AdminController::class, 'nuevoMateria'])->name('materias.create');
Route::middleware('guest')->delete('/materias',[AdminController::class, 'eliminarMateria'])->name('materias.delete');
Route::middleware('guest')->post('/grupos',[AdminController::class, 'nuevoGrupo'])->name('grupos.create');
Route::middleware('guest')->delete('/grupos',[AdminController::class, 'eliminarGrupo'])->name('grupos.delete');
Route::middleware('guest')->post('/inscripciones',[AdminController::class, 'nuevoInscripcion'])->name('inscripciones.create');
Route::middleware('guest')->delete('/inscripciones',[AdminController::class, 'eliminarInscripcion'])->name('inscripciones.delete');
Route::middleware('guest')->delete('/maestros',[AdminController::class, 'eliminarMaestro'])->name('maestros.delete');


Route::get('/maestro', [MaestroController::class, 'index'])->name('maestro');

Route::post('/calificaciones',[MaestroController::class, 'nuevoCalificaciones'])->name('calificaciones.create');
Route::delete('/calificaciones',[MaestroController::class, 'eliminarCalificaciones'])->name('calificaciones.delete');

Route::post('/generate-pdf', [PDFController::class, 'generatePdf'])->name('generate.pdf');

Route::post('/import-excel', [ExcelController::class, 'importExcel'])->name('import.excel');