<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Ruta principal
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para usuarios normales
    Route::middleware(['role:user'])->group(function () {
        Route::get('/my-curriculums', [CurriculumController::class, 'myCurriculums'])->name('curriculums.my');
        Route::get('/library-curriculums', [CurriculumController::class, 'libraryCurriculums'])->name('curriculums.library');
    });

    // Rutas para funcionarios
    Route::middleware(['role:employee'])->group(function () {
        Route::resource('curriculums', CurriculumController::class)->except(['destroy']);
        Route::get('/curriculums/search', [CurriculumController::class, 'search'])->name('curriculums.search');
    });

    // Rutas compartidas (accesibles tanto para usuarios como funcionarios)
    Route::delete('/curriculums/{curriculum}', [CurriculumController::class, 'destroy'])->name('curriculums.destroy');
    Route::get('/curriculums/{curriculum}/download', [CurriculumController::class, 'show'])->name('curriculums.download');

    // Rutas para administradores
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('libraries', LibraryController::class);
        Route::get('/libraries/search', [LibraryController::class, 'search'])->name('libraries.search');
        Route::resource('users', UserController::class);
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    });
});
