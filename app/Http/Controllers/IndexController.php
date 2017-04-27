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
		$this->status = 100;
		return $this->view('index.index', ['title' =>'hahah']);
	}
}
