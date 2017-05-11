<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use  App\Model\NaviModel;
use  App\Model\SortModel;
use App\Model\BlogModel;
//use App\Model\LinkModel;
use App\Model\UserModel;
//use App\lib\PasswordHash;
class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //private $naviModel;
	private $sortModel;
    private $blogModel;
   // private $linkModel;
   private $userModel;
    public function __construct()
    {
        //$this->naviModel = new NaviModel();
		$this->sortModel = new SortModel();
        $this->blogModel = new BlogModel();
        $this->userModel = new UserModel();
        //$this->linkModel = new LinkModel();
    }

    // public function index(){
	// 	// 写入一条数据至 session 中...
	// 	app('session')->put('key','value');

	// 	// 获取session中键值未key的数据
	// 	app('session')->get('key');
	// 	//$results =  	$this->naviModel->findNavi();
	// 	//$results =  	$this->sortModel->menu();
    //     $results =  	$this->linkModel->links();
	// 	return $this->view('index.index', $results);
	// }

    /**
     * 文章首页
     *
     * @return void
     */
    public function index(){

        $result = $this->blogModel->hotBlogList();
        
        $results['sort'] = [
            'sortname'=>'最近更新',
            'description'=>''
        ];
        $results['list'] = $result;
        return $this->view('index.index', $results);
    }

    /**
     * 文章列表
     *
     * @param [文章分类id] $id
     * @param Request $request
     * @return void
     */
    public function getList($id, Request $request){
        $page = $request->input("page");
        if($page<1) $page = 1;
        
        $sort = $this->sortModel->getOne($id);
       
        $results['sort'] = [
            'sortname'=>$sort->sortname,
            'description'=>!empty($sort->description)? $sort->description : '这家伙很懒，还没填写该栏目的介绍呢~'
        ];
        $results['page'] = $page;
        $result = $this->blogModel->getList($id, $page);
        $results['list'] = $result;
        return $this->view('index.index', $results);
    }

    /**
     * 文章详情
     *
     * @param [文章id] $gid
     * @param Request $request
     * @return void
     */
    public function info($gid, Request $request) {
        $results['gid'] = $gid;
        $results['info'] = $this->blogModel->getInfo($gid);
        
        return $this->view('index.index', $results);
    } 

    /**
     * 文章分类
     *
     * @return void
     */
    public function sort()
    {
        $results['list'] = $this->sortModel->sort();
        
        return $this->view('index.index', $results);
    }

    public function login(Request $request)
    {
        $username = $request->input("username");
        $email = $request->input("email");
        $phone = $request->input("phone");
        $password = $request->input("password");
        $results = $this->userModel->checkLogin($username, $password);
       if(!$results){
           $this->status = 10010;
           $this->info = '用户名或密码错误';
       }
        return $this->view('index.index', $results);
    }

    public function user(Request $request){
        $uid = $request->input("uid");
        $results = $this->userModel->userInfo($uid);
       if(!$results){
           $this->status = 10010;
           $this->info = '用户uid不正确';
       }
        return $this->view('index.index', $results);
    }
}
