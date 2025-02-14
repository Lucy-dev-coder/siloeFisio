<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terapeuta;

class TerapeutaController extends Controller
{
    /**
     * Muestra una lista de terapeutas.
     */
    public function index()
    {
      
        return view('terapeutas.index', compact('terapeutas'));
    }
}
