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
}	