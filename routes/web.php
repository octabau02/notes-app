<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;

Route::get('/register', [RegisterController::class, 'showRegisterForm']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/export/{id}', [NoteController::class, 'export'])->name('notes.export');
    Route::put('/notes/update', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('notes/delete/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
});
