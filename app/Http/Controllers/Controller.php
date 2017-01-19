<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $permissions;

    public function hasAnyOptions(\Illuminate\Http\Request $request, $options = null)
    {

        $attributes = $request->user_data['attributes'];

        dump($attributes);
        dump($options);
        $match = array_intersect($attributes, $options);
        dump($match);
        if (!empty($match)) {
            return true;
        }
        return false;
    }

    public function hasAllOptions(\Illuminate\Http\Request $request, $options = null)
    {

        $attributes = $request->user_data['attributes'];

        dump($attributes);
        dump($options);
        $missing = array_diff($options, $attributes);
        dump($missing);
        if (!$missing) {
            return true;
        }
        return false;
    }

}
