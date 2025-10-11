<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'mostrarLogin']);
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login.formulario');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'mostrarRegistro'])->name('register.formulario');
Route::post('/register', [UserController::class, 'agregar'])->name('usuario.agregar');


Route::middleware('auth')->group(function(){
    Route::prefix('notas')->group(function() {
        Route::get('/', [NoteController::class, 'gestor'])->name('notas.gestor');
        Route::post('/', [NoteController::class, 'agregar'])->name('notas.agregar');
        Route::get('/exportar/{id}', [NoteController::class, 'exportar'])->name('notas.exportar');
        Route::patch('/', [NoteController::class, 'editar'])->name('notas.editar');
        Route::delete('/{id}', [NoteController::class, 'eliminar'])->name('notas.eliminar');
    });
});
