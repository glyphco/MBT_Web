<?php

namespace App\Http\Middleware;

use Closure;

class hasAnyAttribute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        dd($guard);
        return $next($request);
    }
}
