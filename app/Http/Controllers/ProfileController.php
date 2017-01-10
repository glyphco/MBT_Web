<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller {

	protected $request;
	protected $guzzler;

	public function __construct(\Illuminate\Http\Request $request, \App\Helpers\guzzler $guzzler) {
		$this->request = $request;
		$this->guzzler = $guzzler;
	}

	public function index(Request $request, $id, $name = null) {
		$data = $this->guzzler->guzzleGET('profile');
		return view('profile-index', ['profile' => $data]);

	}

	public function show(Request $request, $id, $name = null) {
		$data   = $this->guzzler->guzzleGET('profile/' . $id);
		$events = $this->guzzler->guzzleGET('event?current&p=' . $id);
		return view('profile-show', ['profile' => $data, 'events' => $events]);
	}

}
