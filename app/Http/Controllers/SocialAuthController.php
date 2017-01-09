<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Redirect;
use Socialite;

class SocialAuthController extends Controller {

	protected $request;

	public function __construct(\Illuminate\Http\Request $request) {
		$this->request = $request;
	}

	public function redirect($service) {
		//return Socialite::driver($service)->stateless()->redirect();
		return Socialite::driver($service)->redirect();
	}

	public function callback($service) {
		//create a temporary socailuser from the data we just received from the service (stateless because we arent validating state)
		//$socailuser = Socialite::with($service)->user();
		$socailuser = Socialite::with($service)->stateless()->user();
		Log::info('fbtoken: ' . $socailuser->token);

		$client = new Client([
			'base_uri' => env('AUTH_SERVER', 'http://mbtauth.dev'),
			'timeout'  => 5.0,
		]);

		$response = $client->request('GET', '/gettoken/' . $service, [
			'query' => ['token' => $socailuser->token],
		]);

		$contents = $response->getBody()->getContents();
		$jwt      = json_decode($contents, true)['JWT'];
		//dd($jwt);

		$cookie = cookie('token', $jwt, config('jwt.ttl'), "/", null, false, true);

		//return response()->json($jwt)->withCookie($cookie);

		return redirect('\\')->withCookie($cookie);

	}

}
