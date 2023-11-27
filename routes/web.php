<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;


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


//RUTA LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirige a la página de registro después de cerrar sesión
})->name('logout');
