<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller {

	protected $request;

	public function __construct(\Illuminate\Http\Request $request) {
		$this->request = $request;
	}

	public function home(Request $request) {
		$token = $request->cookie('token');

		$client = new Client([
			'base_uri' => env('API_SERVER', 'http://api.myboringtown.com'),
			'timeout'  => 5.0,
		]);

		$contents = $response->getBody()->getContents();

		var_dump($contents);
		var_dump($token);

		dd('done');
		try {

			$response = $client->request('GET', '/userinfo', [
				'query' => ['token' => $token],
			]);

			$contents = $response->getBody()->getContents();

		} catch (RequestException $re) {
			var_dump($re);
		}

		var_dump($contents);
		var_dump($token);

	}

}
