<?php

use App\Http\Controllers\ContextController;
use App\Http\Controllers\EncounterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', AdminController::class)->name('admin');

Route::get('/contexts', [ContextController::class, 'index'])->name('context.index');
Route::get('/context', [ContextController::class, 'create'])->name('context.create');
Route::post('/context', [ContextController::class, 'doCreate'])->name('context.doCreate');
Route::get('/context/{context}', [ContextController::class, 'edit'])->name('context.edit');
Route::patch('/context/{context}', [ContextController::class, 'doEdit'])->name('context.doEdit');
Route::delete('/context/{context}', [ContextController::class, 'doDelete'])->name('context.doDelete');

Route::get('/encounters', [EncounterController::class, 'index'])->name('encounter.index');
Route::get('/encounter', [EncounterController::class, 'create'])->name('encounter.create');
Route::post('/encounter', [EncounterController::class, 'doCreate'])->name('encounter.doCreate');
Route::get('/encounter/{encounter}', [EncounterController::class, 'edit'])->name('encounter.edit');
Route::patch('/encounter/{encounter}', [EncounterController::class, 'doEdit'])->name('encounter.doEdit');
Route::delete('/encounter/{encounter}', [EncounterController::class, 'doDelete'])->name('encounter.doDelete');

Route::get('/generator', GeneratorController::class)->name('generator');

require __DIR__ . '/auth.php';
