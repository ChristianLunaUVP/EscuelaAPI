<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    /** @use HasFactory<\Database\Factories\CarrerasFactory> */
    use HasFactory;
    protected $fillable = ['nombre'];
}
