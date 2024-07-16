<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('prestamos', 'PrestamoController@store')->name('prestamos.store');
Route::get('prestamos', 'PrestamoController@index')->name('prestamos.index');
Route::get('prestamos/create', 'PrestamoController@create')->name('prestamos.create');
Route::get('prestamos/{prestamo}', 'PrestamoController@show')->name('prestamos.show');
Route::get('prestamos/{prestamo}/edit', 'PrestamoController@edit')->name('prestamos.edit');
Route::put('prestamos/{prestamo}', 'PrestamoController@update')->name('prestamos.update');
Route::delete('prestamos/{prestamo}', 'PrestamoController@destroy')->name('prestamos.destroy');

Route::post('libros', 'LibroController@store')->name('libros.store');
Route::get('libros', 'LibroController@index')->name('libros.index');
Route::get('libros/create', 'LibroController@create')->name('libros.create');
Route::get('libros/{libro}', 'LibroController@show')->name('libros.show');
Route::get('libros/{libro}/edit', 'LibroController@edit')->name('libros.edit');
Route::put('libros/{libro}', 'LibroController@update')->name('libros.update');
Route::delete('libros/{libro}', 'LibroController@destroy')->name('libros.destroy');

require __DIR__.'/auth.php';
