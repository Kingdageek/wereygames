<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function start(Request $request)
    {
        $story = Story:: whereNotNull('form')->inRandomOrder()->first();

        return view('start', [
            'story' => $story,
            'formInputs' => json_decode($story->form)
        ]);
    }

}
