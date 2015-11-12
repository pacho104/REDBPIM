<?php namespace App\Http\Middleware;

use Closure;

class existe_plan {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
       if (\Session::has('id_existe_plan'))
        {
           return \Redirect::route('plan_desarrollo')
               ->with('alertExiste','¡..Usted ya ha registrado el plan de desarrollo que se encuentra en pantalla. Modifíquelo antes de crear uno nuevo..!');
        }

        return $next($request);
	}

}
