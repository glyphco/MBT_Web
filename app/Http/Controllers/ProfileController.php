<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProfileController extends Controller {

	protected $request;

	public function __construct(\Illuminate\Http\Request $request) {
		$this->request = $request;
	}

	public function show(Request $request, $id, $name = null) {
		$token = $request->cookie('token');
		try {

			$client = new Client([
				'base_uri' => env('API_SERVER', 'http://api.myboringtown.com'),
				'timeout' => 5.0,
			]);

			$response = $client->request('GET', '/profile/' . $id, [
				'headers' => [
					'Authorization' => 'bearer ' . $token,
				],
			]);

			$contents = $response->getBody()->getContents();

		} catch (RequestException $re) {
			var_dump($re);
		}

		$contents = json_decode($contents, true);
		if ($contents['status'] == 'error') {
			dd($contents);
		}
		$data = $contents['data'];
		//dd($data);
		return view('profile-show', ['profile' => $data]);

	}

}
