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

		try {
			$client = new Client([
				'base_uri' => env('API_SERVER', 'http://mbtapi.dev'),
				'timeout' => 5.0,
			]);

			$response = $client->request('GET', '/userinfo', [
				'query' => ['token' => $token],
			]);

			$contents = $response->getBody()->getContents();

		} catch (\GuzzleHttp\Exception\RequestException $e) {
			$this->errors = json_decode($e->getResponse()->getBody()->getContents());
			dd($this->errors);
		}

		var_dump($contents);
		var_dump($token);

	}

}
