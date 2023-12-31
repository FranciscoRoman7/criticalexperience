<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TiradaDadoController;
use App\Http\Controllers\PerfilController;


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

Route::post('/reg', [RegisteredUserController::class, 'store'])->name('registro');
Route::post('/home', [RegisteredUserController::class, 'login'])->name('login.post');

//RUTAS CALENDARIO
Route::get('/calendario', [EventoController::class, 'index'])->middleware('auth');
Route::get('/calendario/mostrar', [EventoController::class, 'show'])->middleware('auth');
Route::post('/calendario/agregar', [EventoController::class, 'store'])->middleware('auth');
Route::post('/calendario/editar/{id}', [EventoController::class, 'edit'])->middleware('auth');
Route::post('/calendario/actualizar/{evento}', [EventoController::class, 'update'])->middleware('auth');
Route::post('/calendario/borrar/{id}', [EventoController::class, 'destroy'])->middleware('auth');

//RUTAS CRUD USUARIOS
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/delete/{id}', [UserController::class, 'confirmDelete'])->name('users.confirmDelete');
Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//RUTAS CRUD DE CAMPAÑAS
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');

//RUTAS GESTION DE FICHEROS
Route::get('files', [FileController::class, 'index'])->name('files.index');
Route::post('files', [FileController::class, 'store'])->name('files.store');
Route::get('files/{file}/download', [FileController::class, 'download'])->name('files.download');
Route::delete('files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
Route::get('/files/{file}/show',  [FileController::class, 'show'])->name('files.show');

//RUTAS TIRAR DADOS
Route::get('/dados', [TiradaDadoController::class, 'mostrar'])->name('tiradas.mostrar');
Route::post('/dados/guardar', [TiradaDadoController::class, 'guardar'])->name('tiradas.guardar');
Route::delete('/dados/borrar', [TiradaDadoController::class, 'borrarTiradas'])->name('tiradas.borrar');

//RUTAS PERFIL
Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil.show');
Route::post('/perfil/actualizar', [PerfilController::class, 'update'])->name('perfil.update');
Route::post('/perfil/cambiar-contrasena', [PerfilController::class, 'changePassword'])->name('perfil.changePassword');

//RUTA LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
