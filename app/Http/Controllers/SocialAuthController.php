<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
		//$user = Socialite::with($service)->stateless()->user();

		//dd('here');
		$user = Socialite::with($service)->user();

//get token through guzzle (todo) (for now redirect to auth server)
		// $authserver = env('AUTH_SERVER', 'http://mbtweb.dev');
		// $away       = $authserver . '/gettoken/' . $service . '?alias=' . $alias . '&token=' . $user->token;
		//return redirect()->away($away);

		$client = new Client([
			'base_uri' => env('AUTH_SERVER', 'http://mbtauth.dev'),
			'timeout' => 5.0,
		]);

		$response = $client->request('GET', '/gettoken/' . $service, [
			'query' => ['token' => $user->token],
		]);

		// foreach ($response->getHeaders() as $name => $values) {
		// 	echo $name . ':::: ' . implode(', ', $values) . "<br>";
		// }
		$contents = $response->getBody()->getContents();
		$jwt = json_decode($contents, true)['JWT'];
		dd($jwt);
	}

}
