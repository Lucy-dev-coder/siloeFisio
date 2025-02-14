<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
USE App\Http\Controllers\TerapeutaController;
use App\Http\Controllers\PacienteController;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    Route::middleware([RoleMiddleware::class . ':Administrador'])->group(function () {

        Route::resource('pacientes', PacienteController::class);
        // Usamos Route::resource para manejar las rutas de usuarios
        Route::resource('users', UserController::class);
    });
   
     
   
});
// Ruta de login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

// Ruta de logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/terapeutas', [TerapeutaController::class, 'index'])->name('terapeuta.index');
