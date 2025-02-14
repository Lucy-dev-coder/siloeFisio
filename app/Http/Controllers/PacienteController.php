<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    /**
     * Muestra una lista de pacientes.
     */
    public function index()
    {
        // Ordena los pacientes por la fecha de creación de manera descendente (últimos agregados primero)
        $pacientes = Paciente::orderBy('created_at', 'desc')->get();
    
        return view('pacientes.index', compact('pacientes'));
    }
    

    /**
     * Muestra el formulario para crear un nuevo paciente.
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Almacena un nuevo paciente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ci' => 'required|string|unique:pacientes,ci',
            'fecha_nacimiento' => 'required|date',
            'celular' => 'nullable|string|max:20',
            'correo' => 'nullable|email|unique:pacientes,correo',
            'direccion' => 'nullable|string',
            'grupo_sanguineo' => 'nullable|string|max:5',
            'contacto_emergencia' => 'nullable|string|max:255'
        ], [
            'ci.unique' => 'El número de CI ya está registrado.',
            'correo.unique' => 'El correo electrónico ya está registrado.'
        ]);
    
        try {
            Paciente::create($request->all());
            return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('pacientes.create')->withErrors(['error' => 'Hubo un error al registrar al paciente.'])->withInput();
        }
    }
    
    /**
     * Muestra los detalles de un paciente específico.
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Muestra el formulario para editar un paciente.
     */
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Actualiza un paciente en la base de datos.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ci' => 'required|string|unique:pacientes,ci,' . $paciente->id,
            'fecha_nacimiento' => 'required|date',
            'celular' => 'nullable|string|max:20',
            'correo' => 'nullable|email|unique:pacientes,correo,' . $paciente->id,
            'direccion' => 'nullable|string',
            'grupo_sanguineo' => 'nullable|string|max:5',
            'contacto_emergencia' => 'nullable|string|max:255'
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
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
