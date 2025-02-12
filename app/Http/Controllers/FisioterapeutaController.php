<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FisioterapeutaController extends Controller
{
    public function index()
    {
        // Solo una página sencilla por ahora
        return view('fisioterapeuta.index');

        //hola que tal?
    }
}
