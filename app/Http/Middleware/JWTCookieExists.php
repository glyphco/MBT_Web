<?php

namespace App\Http\Middleware;

use Closure;

class JWTCookieExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function __construct(\Illuminate\Http\Request $request, \App\Helpers\guzzler $guzzler)
    {
        $this->request = $request;
        $this->guzzler = $guzzler;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->cookie('token');

        if (is_null($token)) {
            return redirect('login');
        }

//get the userinfo and stash it in the request object.... why not?
        $data = $this->guzzler->guzzleGET('me');
        $request->merge(["user_data" => $data]);
//lat lon?

        //ipget latlon
        //save to DB

        // $user_data = $request->instance()->query('user_data');
        // dd($user_data['facebook_id']);
        //set cookie

        return $next($request);
    }
}
