<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomepageController extends Controller {

	protected $request;

	public function __construct(\Illuminate\Http\Request $request) {
		$this->request = $request;
	}

	public function __invoke(Request $request) {
		$token = $request->cookie('token');

		try {
			$client = new Client([
				'base_uri' => env('API_SERVER', 'http://mbtapi.dev'),
				'timeout' => 5.0,
			]);

			$response = $client->request('GET', '/event', [
				'query' => ['token' => $token],
			]);

			$contents = $response->getBody()->getContents();

		} catch (\GuzzleHttp\Exception\RequestException $e) {
			$code = $e->getResponse()->getStatusCode();
			$reason = $e->getResponse()->getReasonPhrase();
			switch ($code) {
			case '403':
				$error = 'you dont have permission for that resource [' . $reason . ']';
				break;
			case '401':
				$error = 'your token has expired [' . $reason . ']';
				break;
			default:
				$error = 'unknown error';
				break;
			}
			var_dump($token);
			dd('oops', $error);
		}

		$contents = json_decode($contents, true);
		if ($contents['status'] == 'error') {
			dd($contents);
		}

		//var_dump($contents['data'][4]);
		// var_dump($token);
		$data = array_values(array_sort($contents['data'], function ($value) {
			return $value['start'];
		}));
		return view('homepage', ['data' => $data]);
	}

}
