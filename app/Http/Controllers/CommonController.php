<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		$this->format = $request->input('format');
    }

}
