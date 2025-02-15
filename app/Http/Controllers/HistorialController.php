<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    /**
     * Muestra una lista de historiales.
     */
    public function index()
{
    $historiales = Historial::with('paciente', 'user')->get();
    $pacientes = Paciente::all();

    return view('historiales.index', compact('historiales', 'pacientes'));
}


    /**
     * Muestra el formulario para crear un nuevo historial.
     */
    public function create()
    {
        $pacientes = Paciente::all(); // Obtener todos los pacientes para el formulario
        return view('historiales.create', compact('pacientes'));
    }

    /**
     * Guarda un nuevo historial en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'motivo_consulta' => 'required|string',
        ]);

        Historial::create([
            'user_id' => Auth::id(),// Asigna el usuario autenticado
            'paciente_id' => $request->paciente_id,
            'motivo_consulta' => $request->motivo_consulta,
        ]);

        return redirect()->route('historiales.index')->with('success', 'Historial creado correctamente.');
    }

    /**
     * Muestra un historial específico.
     */
    public function show(Historial $historial)
    {
        return view('historiales.show', compact('historial'));
    }

    /**
     * Muestra el formulario para editar un historial.
     */
    public function edit(Historial $historial)
    {
        $pacientes = Paciente::all();
        return view('historiales.edit', compact('historial', 'pacientes'));
    }

    /**
     * Actualiza un historial en la base de datos.
     */
    public function update(Request $request, Historial $historial)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'motivo_consulta' => 'required|string',
        ]);

        $historial->update([
            'paciente_id' => $request->paciente_id,
            'motivo_consulta' => $request->motivo_consulta,
        ]);

        return redirect()->route('historiales.index')->with('success', 'Historial actualizado correctamente.');
    }

    /**
     * Elimina un historial de la base de datos.
     */
    public function destroy(Historial $historial)
    {
        $historial->delete();
        return redirect()->route('historiales.index')->with('success', 'Historial eliminado correctamente.');
    }
}
