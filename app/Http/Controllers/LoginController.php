<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller {

	protected $request;

	public function __construct(\Illuminate\Http\Request $request) {
		$this->request = $request;
	}

	public function __invoke() {
		$cookie = \Cookie::forget('token');
		return view('login')->withCookie($cookie);
	}

}
