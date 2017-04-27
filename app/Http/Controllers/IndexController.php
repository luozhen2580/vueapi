<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
    }

    public function index(){
		return $this->view('index.index', ['title' =>'hahah']);
	}
}
