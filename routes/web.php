<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\SSOLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('generator.index');
})->middleware(['auth', 'verified'])->name('generator.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/generator', [GeneratorController::class, 'index'])->name('generator.index');
    Route::post('/generator', [GeneratorController::class, 'generate'])->name('generator.generate');
});

Route::get('/auth/redirect', [SSOLoginController::class, 'redirectToProvider'])->name('sso.redirect');
Route::get('/auth/callback', [SSOLoginController::class, 'handleProviderCallback'])->name('sso.callback');


require __DIR__.'/auth.php';
