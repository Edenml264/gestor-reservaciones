<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Livewire\Admin\ReservationManager;
use App\Livewire\Admin\ServiceManager;
use App\Livewire\Admin\VehicleManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('services.index');
});

// Rutas públicas
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('reservations.index');
    })->name('dashboard');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de administración de reservaciones
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // Rutas de administración
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/reservations', ReservationManager::class)->name('reservations');
        Route::get('/services', ServiceManager::class)->name('services');
        Route::get('/vehicles', VehicleManager::class)->name('vehicles');
    });
});

require __DIR__.'/auth.php';
