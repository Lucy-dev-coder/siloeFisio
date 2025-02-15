<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historiales'; // Especificamos el nombre correcto de la tabla

    protected $fillable = [
        'user_id',
        'paciente_id',
        'motivo_consulta',
    ];

    /**
     * Relación con el modelo User.
     * Un historial pertenece a un usuario (opcional si el usuario es eliminado).
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Relación con el modelo Paciente.
     * Un historial pertenece a un paciente.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
