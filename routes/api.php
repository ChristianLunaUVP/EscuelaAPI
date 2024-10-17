<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\AuthController;


Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('alumnos', AlumnosController::class);
    Route::resource('carreras', CarrerasController::class);
    Route::get('alumnosall', [AlumnosController::class, 'all']);
    Route::get('alumnosporcarrera', [AlumnosController::class,
            'alumnosPorCarrera']);

    Route::get('auth/logout', [AuthController::class, 'logout']);
});



