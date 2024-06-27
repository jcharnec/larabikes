<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, int $minimo)
    {
        //miramos si el usuario es menor de edad
        if($request->query('edad')<$minimo)
            return redirect()->away('http://juegayestudia.com', 302);
            //abort(403, 'Acceso denegado, debes ser mayor de edad para acceder a este contenido.');

        // cuando tengamso el modelo User, podremos comprobar la edad del usuario
        // id($user->edad <18)...
        
        return $next($request);
    }
}
