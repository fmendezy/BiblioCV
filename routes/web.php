<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\UserController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas para gestión de currículums (usando resource)
Route::resource('curriculums', CurriculumController::class);

// Rutas para gestión de usuarios
Route::resource('users', UserController::class);
