<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\HomeController;
use App\Http\controllers\AdminController;

Route::get('/', [AdminController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->post('/nuevoVotacion',[AdminController::class, 'nuevoVotacion'])->name('votaciones.create');
Route::middleware('guest')->post('/nuevoCandidato',[AdminController::class, 'nuevoCandidato'])->name('candidatos.create');

Route::post('/nuevoVoto',[HomeController::class, 'nuevoVoto'])->name('votos.create');