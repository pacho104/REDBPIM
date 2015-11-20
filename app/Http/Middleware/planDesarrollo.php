<?php namespace App\Http\Middleware;

use Closure;

class planDesarrollo {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $plan = \Session::get('id_plan');

        if (is_null($plan))
        {
            return \Redirect::route('new_plan_municipal');
        }

        return $next($request);
	}

}
