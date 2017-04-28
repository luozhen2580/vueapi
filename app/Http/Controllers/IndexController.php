<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Model\NaviModel;
use  App\Model\SortModel;
class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $naviModel;
	private $sortModel;
    public function __construct()
    {
        $this->naviModel = new NaviModel();
		$this->sortModel = new SortModel();
    }

    public function index(){
		
		$results =  	$this->naviModel->findNavi();
		$results =  	$this->sortModel->menu();

		return $this->view('index.index', $results);
	}
}
