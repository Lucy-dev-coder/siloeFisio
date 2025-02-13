<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    public function run()
    {
        // Limpiar la tabla antes de insertar nuevos datos (opcional)
        DB::table('pacientes')->truncate();

        // Insertar datos de prueba
        Paciente::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'ci' => '12345678',
            'fecha_nacimiento' => '1990-05-15',
            'celular' => '76543210',
            'correo' => 'juan.perez@example.com',
            'direccion' => 'Av. Siempre Viva 123',
            'grupo_sanguineo' => 'O+',
            'contacto_emergencia' => 'Maria Pérez - 78965412',
        ]);

        Paciente::create([
            'nombres' => 'Ana',
            'apellidos' => 'González',
            'ci' => '87654321',
            'fecha_nacimiento' => '1985-10-20',
            'celular' => '71234567',
            'correo' => 'ana.gonzalez@example.com',
            'direccion' => 'Calle Falsa 456',
            'grupo_sanguineo' => 'A-',
            'contacto_emergencia' => 'Luis González - 78912345',
        ]);
    }
}
