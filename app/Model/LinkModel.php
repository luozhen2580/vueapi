<?php
namespace App\Model;
use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;
class LinkModel extends BaseModel
{
	public function __construct()
    {
        $this->table = 'link';
		$this->model = $db = DB::table($this->table);
    }
    public function links(){
        $data = ['sitename' => 'john@example.com', 'siteurl' => '77777','description'=>'777'];
        $where = ['id', '=', '6'];



        return $this->sql('select * from bk_link','select');
	}
}	