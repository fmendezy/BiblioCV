<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        // Los administradores tienen acceso a todo
        if (auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Los funcionarios tienen acceso a las rutas de funcionarios y usuarios
        if (auth()->user()->isEmployee() && $role === 'user') {
            return $next($request);
        }

        // Verificación normal de roles
        if (auth()->user()->role !== $role) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
}
