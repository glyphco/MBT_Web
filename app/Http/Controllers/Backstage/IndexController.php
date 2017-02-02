<?php
namespace App\Http\Controllers\backstage;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function __construct()
    {

    }

    public function __invoke()
    {

        return view('backstage.index');

    }

}
