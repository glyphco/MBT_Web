<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Redirect;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller {

   protected $request;

   public function __construct(\Illuminate\Http\Request $request)
   {
       $this->request = $request;
   }

	public function gettoken($service) {
	$request = $this->request->all();
	$socialize_user = Socialite::driver($service)->userFromToken($request['token']);

	dump('requested token');
	dd('ID:'.$socialize_user->getId());

//tie in the user model
    $user = User::where($service.'_user_id', $socialize_user->getId())->first();

    // register (if no user)
    if (!$user) {
        $user = new User;
        $user->facebook_id = $facebook_user_id;
        $user->save();
    }

    // login
    Auth::loginUsingId($user->id);


	dump();
dd($user);

// $request = new \GuzzleHttp\Psr7\Request('GET', 'http://mbtweb.dev/');
// $promise = $client->sendAsync($request)->then(function ($response) {
//     echo 'I completed! ' . $response->getBody();
// });
// $promise->wait();

// 			$user = Socialite::driver($service)->userFromToken($request['token']);
// 			dd($user);
// 			//return view ( 'home' )->withDetails ( $user )->withService ( $service );
	}

// 	public function servetoken($service) {

// $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
// $promise = $client->sendAsync($request)->then(function ($response) {
//     echo 'I completed! ' . $response->getBody();
// });
// $promise->wait();

// 			$user = Socialite::driver($service)->userFromToken($request['token']);
// 			dd($user);
// 			//return view ( 'home' )->withDetails ( $user )->withService ( $service );
// 	}
}
