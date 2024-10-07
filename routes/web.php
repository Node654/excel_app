<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ProjectController::class)->group(function () {
    Route::post('/projects/import/store', 'importStore')->name('project.import.store');
    Route::get('/projects', 'index')->name('project.index');
    Route::get('/projects/import', 'import')->name('project.import');
})->middleware('auth:sanctum');

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index')->name('task.index');
    Route::get('/tasks/{task}/failed_list', 'failedList')->name('tasks.failed-list');
})->middleware('auth:sanctum');

require __DIR__.'/auth.php';
