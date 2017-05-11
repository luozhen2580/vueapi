<?php
namespace App\Model;
use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;
class SortModel extends BaseModel
{
   // protected $table = 'sort';
	public function __construct()
    {
        $this->table = 'sort';
		$this->model = $db = DB::table($this->table);
    }
    public function menu(){
		return $this->fetchOne(['pid'=>0,'sid'=>['1', '>']] , '*', 'sid');
	}

    public function getOne($id){
         return  DB::table($this->table)
        ->where('sid', '=', $id)
        ->first();
    }

    public function sort($pid = 0){
        $data = DB::table($this->table)->where('pid','=',$pid)->orderby('taxis')->get();
        foreach($data as &$value){
            $value->list = DB::table($this->table)->where('pid','=',$value->sid)->orderby('taxis')->get();
        }

        return $data;
    }

    
}	