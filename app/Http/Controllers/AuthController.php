<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de que tengas esta vista
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
       
if (Auth::attempt($request->only('email', 'password'))) {
    // Redirigir a los usuarios según su rol
    if (Auth::user()->role->rol == 'Administrador') {
        return redirect()->route('users.index'); // Administrador redirigido a la lista de usuarios
    }

    return redirect()->route('terapeuta.index'); // Redirige a una página por defecto (puedes cambiarla)
}

        // Si falla la autenticación, redirige con un error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);

    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}

