<?php

use App\Http\Controllers\AffiliatesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rotas para o usuario logado com auth
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'list'])->name('profile.list');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas para os usuarios cadastrados pelo auth
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('/users/password/{user}', [UserController::class, 'updatePassword'])->name('users.password.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/affiliates', [AffiliatesController::class, 'index'])->name('affiliates.index');
    Route::get('/affiliates/create', [AffiliatesController::class, 'create'])->name('affiliates.create');
    Route::post('/affiliates', [AffiliatesController::class, 'store'])->name('affiliates.store');
    Route::get('/affiliates/{affiliate}/edit', [AffiliatesController::class, 'edit'])->name('affiliates.edit');
    Route::patch('/affiliates/{affiliate}', [AffiliatesController::class, 'update'])->name('affiliates.update');
    Route::delete('/affiliates/{affiliate}', [AffiliatesController::class, 'destroy'])->name('affiliates.destroy');

    Route::get('/commition', [CommitionController::class, 'index'])->name('commition.index');
    Route::get('/commition/create', [CommitionController::class, 'create'])->name('commition.create');
    Route::post('/commition', [CommitionController::class, 'store'])->name('commition.store');
    Route::get('/commition/{commition}/edit', [CommitionController::class, 'edit'])->name('commition.edit');
    Route::patch('/commition/{commition}', [CommitionController::class, 'update'])->name('commition.update');
    Route::delete('/commition/{commition}', [CommitionController::class, 'destroy'])->name('commition.destroy');
});

require __DIR__.'/auth.php';
