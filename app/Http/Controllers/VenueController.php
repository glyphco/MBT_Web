<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Validator;

class VenueController extends Controller
{

    protected $request;
    protected $guzzler;
    protected $validationRules = [
        'name'           => 'required',
        'category'       => 'required',
        'street_address' => 'required',
        'city'           => 'required',
        'state'          => 'required',
        'postalcode'     => 'required',
        'lat'            => 'required',
        'lng'            => 'required',
    ];

    public function __construct(\Illuminate\Http\Request $request, \App\Helpers\guzzler $guzzler)
    {
        $this->request = $request;
        $this->guzzler = $guzzler;
    }

    // Route::put('/venue/{id}', 'VenueController@update')->name('venue.update');

    public function index(Request $request)
    {
        $data = $this->guzzler->guzzleGET('venue');
        return view('venue.index', ['venues' => $data]);
    }

    public function show(Request $request, $id, $name = null)
    {
        $data   = $this->guzzler->guzzleGET('venue/' . $id);
        $events = $this->guzzler->guzzleGET('event?current&v=' . $id);
        return view('venue.show', ['venue' => $data, 'events' => $events]);
    }

    public function create()
    {
        return view('pages.venue.create');
    }

    public function edit($id)
    {
        $data = $this->guzzler->guzzleGET('venue/' . $id);
        return view('venue.edit', ['venue' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('user_data');

        $validator = Validator::make($input, $this->validationRules);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        dump($input);
        $data = $this->guzzler->guzzlePOST('venue/', $input);

        dd($data);

    }

    public function update($id)
    {
        $input     = $request->except('user_data');
        $validator = Validator::make($input, $this->validationRules);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        dump($input);
        $data = $this->guzzler->guzzlePOST('venue/', $input);

        dd($data);
    }

    public function destroy($id)
    {
        $data = $this->guzzler->guzzleDELETE('venue/' . $id);
        $data = $this->guzzler->guzzleGET('venue');
        return view('venue-index', ['venues' => $data]);
    }

    public function map(Request $request)
    {
        $token = $request->cookie('token');

        $l = $request->input('l', '41.291824,-87.763978');
        $d = $request->input('d', 100000); //(in meters)

        try {

            $client = new Client([
                'base_uri' => env('API_SERVER', 'http://api.myboringtown.com'),
                'timeout'  => 5.0,
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
