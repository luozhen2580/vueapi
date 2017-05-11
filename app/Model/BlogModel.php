<?php
namespace App\Model;
use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;
class BlogModel extends BaseModel
{
	public function __construct()
    {
        $this->table = 'blog';
		$this->model = $db = DB::table($this->table);
    }
    public function blogs(){
        $where = ['sortid','>',0];
        $orderby = ['gid'=>'desc'];
        $join = [['sort','sort.sid','blog.sortid','left']]; 
        $field = ['blog.gid','blog.title'];
        $limit = 4;
        $offset = 2;
       // $where = [], $field = [], $order='', $limit='', $join = []
		return $this->count($where, $field, $orderby, $join);
	}


    public function hotBlogList()
    {
        $result =  DB::table($this->table)
        ->where('sortid', '>', 0)
        ->limit(10)
        ->select(['gid','title','content'])
        ->orderby('gid','desc')
        ->get();
        foreach($result as &$value) {
            $value->content = self::cn_substr_utf8(strip_tags($value->content), 200);
            if(strlen($value->content)>=200) {
                $value->content = $value->content . '...';
            }
             $value->img = 'http://www.luozhen.top/content/templates/emlog_dux/images/random/'.rand(1,20).'.jpg';
        }
        return $result;
    }

    public function  getList($sortid = 0, $page = 0)
    {
        //
        $offset = ($page - 1) * 10;

        $result =  DB::table($this->table)
        ->where('sortid', '=', $sortid)
        ->limit(10)
        ->offset($offset)
        ->select(['gid','title','content'])
        ->orderby('gid','desc')
        ->get();
        foreach($result as &$value) {
            $value->content = self::cn_substr_utf8(strip_tags($value->content), 200);
            if(strlen($value->content)>=200) {
                $value->content = $value->content . '...';
            }
             $value->img = 'http://www.luozhen.top/content/templates/emlog_dux/images/random/'.rand(1,20).'.jpg';
        }
        return $result;
    }

    public function getInfo($gid){
        return  DB::table($this->table)
        ->where('gid', '=', $gid)
        ->select(['gid','title','content','date','views','author'])
        ->first();
    }
    
}	