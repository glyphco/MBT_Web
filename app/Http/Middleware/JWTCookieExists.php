<?php

namespace App\Http\Middleware;

use Closure;

class JWTCookieExists {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {
		$token = $request->cookie('token');

		if (is_null($token)) {
			return redirect('login');
		}

		return $next($request);
	}
}
