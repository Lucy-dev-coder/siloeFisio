<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombres',
        'apellidos',
        'ci',
        'fecha_nacimiento',
        'celular',
        'correo',
        'direccion',
        'grupo_sanguineo',
        'contacto_emergencia'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date'
    ];
}