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
}	