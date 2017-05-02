<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Model\NaviModel;
use  App\Model\SortModel;
use App\Model\BlogModel;
use App\Model\LinkModel;
class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $naviModel;
	private $sortModel;
    private $blogModel;
    private $linkModel;
    public function __construct()
    {
        $this->naviModel = new NaviModel();
		$this->sortModel = new SortModel();
        $this->blogModel = new BlogModel();
        $this->linkModel = new LinkModel();
    }

    public function index(){
		// 写入一条数据至 session 中...
		app('session')->put('key','value');

		// 获取session中键值未key的数据
		app('session')->get('key');
		//$results =  	$this->naviModel->findNavi();
		//$results =  	$this->sortModel->menu();
        $results =  	$this->linkModel->links();
		return $this->view('index.index', $results);
	}
}
