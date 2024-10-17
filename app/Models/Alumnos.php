<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    /** @use HasFactory<\Database\Factories\AlumnosFactory> */
    use HasFactory;
    protected $fillable = ['matricula', 'nombre', 'carrera_id', 'semestre', 'imagen'];

    
}
