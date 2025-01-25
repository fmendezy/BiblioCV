<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurriculumController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para usuarios
    Route::middleware(['role:user'])->group(function () {
        Route::get('/my-curriculums', [CurriculumController::class, 'myCurriculums'])->name('curriculums.my');
    });

    // Rutas para funcionarios
    Route::middleware(['role:employee'])->group(function () {
        Route::resource('curriculums', CurriculumController::class);
        Route::get('/curriculums/search', [CurriculumController::class, 'search'])->name('curriculums.search');
    });

    // Ruta compartida para ver curriculum (la protección está en el controlador)
    Route::get('/curriculums/{curriculum}/download', [CurriculumController::class, 'show'])->name('curriculums.show');
});


require __DIR__.'/auth.php';
