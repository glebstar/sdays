<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Sday;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'cities' => City::orderBy('id')->get(),
        ]);
    }

    public function sdays(Request $request)
    {
        return response()->json(Sday::getResult($request->city_id));
    }
}
