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
});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
    Route::get('/curriculums/create', [CurriculumController::class, 'create'])->name('curriculums.create');
    Route::post('/curriculums', [CurriculumController::class, 'store'])->name('curriculums.store');
    Route::get('/curriculums/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculums.edit');
    Route::put('/curriculums/{id}', [CurriculumController::class, 'update'])->name('curriculums.update');
    Route::delete('/curriculums/{id}', [CurriculumController::class, 'destroy'])->name('curriculums.destroy');
});


require __DIR__.'/auth.php';
