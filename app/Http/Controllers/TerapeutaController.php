<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerapeutaController extends Controller
{
    public function index()
    {
        // Solo una página sencilla por ahora
        return view('terapeuta.index');
    }
}
