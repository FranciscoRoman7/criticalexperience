<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EventoController;



//RUTAS DE REGISTRO Y LOGIN
Route::view('/','regis')->name('login')->middleware('guest');

Route::get('/home', function () {
    $user = auth()->user();
    $isAdmin = $user ? $user->admin : false;
    return view('home', [
        'username' => $user ? $user->name : null,
        'isAdmin' => $isAdmin,
    ]);
})->name('home')->middleware('auth');

Route::post('/', [RegisteredUserController::class, 'store'])->name('registro');
Route::post('/home', [RegisteredUserController::class, 'login'])->name('login.post');

//RUTAS CALENDARIO
Route::get('/calendario', [EventoController::class, 'index'])->middleware('auth');
Route::get('/calendario/mostrar', [EventoController::class, 'show'])->middleware('auth');
Route::post('/calendario/agregar', [EventoController::class, 'store'])->middleware('auth');
Route::post('/calendario/editar/{id}', [EventoController::class, 'edit'])->middleware('auth');
Route::post('/calendario/actualizar/{evento}', [EventoController::class, 'update'])->middleware('auth');
Route::post('/calendario/borrar/{id}', [EventoController::class, 'destroy'])->middleware('auth');


//RUTA LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
