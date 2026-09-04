<?php

use App\Http\Controllers\Api\SijunaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('sijuna')->group(function () {
    Route::get('/students', [SijunaController::class, 'students'])->name('api.sijuna.students');
    Route::get('/teachers', [SijunaController::class, 'teachers'])->name('api.sijuna.teachers');
});