<?php
namespace App\Model;
use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;
class TagModel extends BaseModel
{
   // protected $table = 'sort';
	public function __construct()
    {
        $this->table = 'tag';
		$this->model = $db = DB::table($this->table);
    }
 

    public function tag(){
        $data = DB::table($this->table)->orderby('tid')->get();
      
        return $data;
    }

    public function tagList($tid= 0, $page = 0){
		
		$result = DB::table($this->table)
        ->where('tid', '=', $tid)
        ->first();
		$gids = trim($result->gid, ',');
		if(empty($gids)){
			return false;
		}
		$offset = ($page - 1) * 10;
        $result =  DB::table('blog')
        ->whereIn('gid',  explode(',' , $gids))
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
}	