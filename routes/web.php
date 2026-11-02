<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('pasien', PatientController::class);

Route::resource('dokter', DoctorController::class)
    ->parameters(['dokter' => 'dokter'])
    ->only(['index', 'create', 'store', 'edit', 'update']);

Route::resource('poli', PoliController::class);

Route::resource('pendaftaran', RegistrationController::class)
    ->parameters(['pendaftaran' => 'pendaftaran'])
    ->except(['show']);

Route::get('/jadwal', [ScheduleController::class, 'index'])
    ->name('jadwal.index');

Route::get('/jadwal/{hari}', [ScheduleController::class, 'show'])
    ->name('jadwal.show');
