<?php

use App\Http\Controllers\AffiliatesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommissionController;
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

    Route::get('/commission', [CommissionController::class, 'index'])->name('commission.index');
    Route::get('/commission/create', [CommissionController::class, 'create'])->name('commission.create');
    Route::post('/commission', [CommissionController::class, 'store'])->name('commission.store');
    Route::get('/commission/{commission}/edit', [CommissionController::class, 'edit'])->name('commission.edit');
    Route::patch('/commission/{commission}', [CommissionController::class, 'update'])->name('commission.update');
    Route::delete('/commission/{commission}', [CommissionController::class, 'destroy'])->name('commission.destroy');
});

require __DIR__.'/auth.php';
