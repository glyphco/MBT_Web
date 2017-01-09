<?php
namespace App\Helpers;

use GuzzleHttp\Client;

//use Illuminate\Http\Request;

class guzzler {

	public function __construct(\Illuminate\Http\Request $request) {
		$this->request = $request;
	}

	public function guzzleGET($location, $params = null) {
		$token   = $this->request->cookie('token');
		$options = [
			//'http_errors' => false,
			'headers' => [
				'Authorization' => 'bearer ' . $token,
				'Accept'        => 'application/json',
			]];
		$client = new Client([
			'base_uri' => env('API_SERVER', 'http://api.myboringtown.com'),
			'timeout'  => 5.0,
		]);

		try {

			$response = $client->request('GET', $location, $options);
			//$response = $client->request('GET', 'http://httpstat.us/404', $options); //force an error (testing)

			$contents = $response->getBody()->getContents();

		} catch (\GuzzleHttp\Exception\ConnectException $e) {

			$this->handleException($e);

		} catch (\GuzzleHttp\Exception\ClientException $e) {
			$this->handleException($e);
		} catch (GuzzleHttp\Exception\ServerException $e) {
			$this->handleException($e);
		}
		$contents = json_decode($contents, true);

		if ($contents['status'] == 'error') {
			dd($contents);
		}

		//var_dump($contents['data'][4]);
		// var_dump($token);
		return $contents['data'];

	}

	private function handleException($e) {
		$token  = $this->request->cookie('token');
		$code   = $e->getResponse()->getStatusCode();
		$reason = $e->getResponse()->getReasonPhrase();
		switch ($code) {
			case '403':
				$error = $code . ': you dont have permission for that resource [' . $reason . ']';
				break;
			case '401':
				$error = $code . ': your token has expired [' . $reason . ']';
				break;
			case '404':
				$error = $code . ': unable to locate data [' . $reason . ']';
				break;
			case '500':
				$error = $code . ': problem with the server [' . $reason . ']';
				break;
			default:
				$error = $code . ': unknown error';
				break;
		}

		return response(view('error')
				->with('error', $error . ' (prettier errors soon)')
				->with('token', $token))->send();
	}
}
