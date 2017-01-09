<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VenueController extends Controller {

	protected $request;
	protected $guzzler;

	public function __construct(\Illuminate\Http\Request $request, \App\Helpers\guzzler $guzzler) {
		$this->request = $request;
		$this->guzzler = $guzzler;
	}

	public function index(Request $request, $id, $name = null) {
		$data = $this->guzzler->guzzleGET('venue');
		return view('venue-index', ['venue' => $data]);
	}

	public function show(Request $request, $id, $name = null) {
		$data = $this->guzzler->guzzleGET('venue/' . $id);
		return view('venue-show', ['venue' => $data]);
	}

	public function map(Request $request) {
		$token = $request->cookie('token');

		$l = $request->input('l', '41.291824,-87.763978');
		$d = $request->input('d', 100000); //(in meters)

		try {

			$client = new Client([
				'base_uri' => env('API_SERVER', 'http://api.myboringtown.com'),
				'timeout' => 5.0,
			]);

			$response = $client->request('GET', '/venue/map', [
				'query' => ['token' => $token, 'l' => $l, 'd' => $d],
			]);

			$contents = $response->getBody()->getContents();

		} catch (RequestException $re) {
			var_dump($re);
		}

		var_dump(json_decode($contents, true));
		var_dump($token);

	}

}
