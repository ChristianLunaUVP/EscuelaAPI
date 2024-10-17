<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::put('/alumnos/{id}', [AlumnosController::class, 'update']);
Route::delete('/alumnos/{id}', [AlumnosController::class, 'destroy']);
Route::get('/alumnos/{alumnos}', [AlumnosController::class, 'show']);