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
    public function __construct(NaviModel $naviModel, SortModel $sortModel)
    {
        $this->naviModel = $naviModel;
		 $this->sortModel = $sortModel;
    }

    public function index(){
		
	$results =  	$this->naviModel->findNavi();
	$results =  	$this->sortModel->menu();
		//$results = app('db')->table('navi')->get();
		var_dump($results);die;
		return $this->view('index.index', ['title' =>'hahah']);
	}
}
