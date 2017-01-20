<?php
namespace App\Http\Controllers;

//use App\Helpers\guzzler;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $request;
    protected $guzzler;

    public function __construct(\Illuminate\Http\Request $request, \App\Helpers\guzzler $guzzler)
    {
        $this->request = $request;
        $this->guzzler = $guzzler;
    }

    public function __invoke()
    {

        $data = $this->guzzler->guzzleGET('event?current');

        // $data = array_values(array_sort($data, function ($value) {
        //     return $value['start'];
        // }));

        return view('pages.events', ['events' => $data]);

    }

}
