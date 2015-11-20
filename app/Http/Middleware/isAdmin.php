<?php namespace App\Http\Middleware;

use Closure;

class isAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->level() < 4) {
            abort(403, "¡Usted no tiene los permisos para ingresar a este proceso.");
        }
        return $next($request);
    }

}
