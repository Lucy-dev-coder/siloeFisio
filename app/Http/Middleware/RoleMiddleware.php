<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario no está autenticado
        if (!Auth::check()) {
            return redirect('/'); // Redirige a la página principal si no está logeado
        }

        // Verifica si el usuario tiene el rol adecuado
        if (Auth::user()->role->rol !== $role) {
            abort(403, 'No autorizado'); // Lanza un error 403 si no tiene el rol adecuado
        }

        return $next($request); // Permite que la solicitud continúe si el rol es el correcto
    }
}
