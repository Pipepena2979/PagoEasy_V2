<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

// Página principal (index para usuarios)
Route::get('/', [ServiceController::class, 'index'])->name('index');

// Rutas para pagar servicios
Route::post('/pagar', [PaymentController::class, 'pagar'])->name('pagar');

// CRUD de Servicios (para administración)
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'servicesIndex'])->name('services.index'); 
    Route::get('/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/', [ServiceController::class, 'store'])->name('services.store');         
    Route::get('/{id}', [ServiceController::class, 'show'])->name('services.show');        
    Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');    
    Route::put('/{id}', [ServiceController::class, 'update'])->name('services.update');     
    Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

// Rutas para crear usuarios
Route::post('/user', [UserController::class, 'store'])->name('user.store');