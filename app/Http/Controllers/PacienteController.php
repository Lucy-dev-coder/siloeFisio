<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Muestra la lista de pacientes.
     */
    public function index()
    {
        $pacientes = Paciente::all(); // Obtener todos los pacientes
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Guarda un nuevo paciente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ci' => 'required|string|max:20|unique:pacientes', // Validación de CI único
            'fecha_nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:pacientes',
            'direccion' => 'nullable|string',
            'grupo_sanguineo' => 'nullable|string|max:10',
            'contacto_emergencia' => 'nullable|string|max:20',
        ]);

        Paciente::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'ci' => $request->ci,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'grupo_sanguineo' => $request->grupo_sanguineo,
            'contacto_emergencia' => $request->contacto_emergencia,
        ]);

        session()->flash('success', 'Paciente creado correctamente.');
        return redirect()->route('pacientes.index');
    }

    /**
     * Actualiza un paciente en la base de datos.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ci' => 'required|string|max:20|unique:pacientes,ci,' . $paciente->id,
            'fecha_nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:pacientes,correo,' . $paciente->id,
            'direccion' => 'nullable|string',
            'grupo_sanguineo' => 'nullable|string|max:10',
            'contacto_emergencia' => 'nullable|string|max:20',
        ]);

        $paciente->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'ci' => $request->ci,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'grupo_sanguineo' => $request->grupo_sanguineo,
            'contacto_emergencia' => $request->contacto_emergencia,
        ]);

        session()->flash('success', 'Paciente actualizado correctamente.');
        return redirect()->route('pacientes.index');
    }

    /**
     * Elimina un paciente de la base de datos.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
