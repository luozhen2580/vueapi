<?php
namespace App\Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;
/**
 * 数据库操作类
 */
class BaseModel extends Model
{   
    protected $table;
    protected $model;

    public function __construct()
    {
        
    }
	/**
     * 通过条件查询一条数据
     *
     * @return void
     */
	public function fetchOne($where = [], $field = '', $order='', $join = [] )
    { 
        //return false;
        DB::connection()->enableQueryLog(); 
        //return app('db')->table($this->table)->lists('sortname');
       // $db = $this->model;
        
                        $this->model->where(
                            function($query){
                                $query->where('sid','<','61');
                                $query->where('pid','=','0');
                            }
                        )
                        ->orwhere('pid', 1);
                       $this->model->orderBy('sid','desc');
                        $this->model->orderBy('pid','asc');
                       // ->orderby(['sid','pid'],['desc','asc'])
                    //    ->orderBy(function($order){
                    //        $order->orderby('sid','asc');
                    //    })
                   // ->orderby([['column' => 'sid', 'direction' => 'desc'],['column' => 'pid', 'direction' => 'asc']])
                        $this->model->get();
 


 
    // 获取已执行的查询数组
   DB::table($this->table)->where(['sid'=>1,'pid'=>0])->orderBy('sid','asc')->get();

    $log = DB::getQueryLog();
   dd($log);   //打印sql语句
 

 exit;


        //return app('db')->table($this->table)->value($field)->get();
    }

    /**
     * 通过条件获取多条数据
     *
     * @return void
     */
    public function  fetchAll()
    {

    }

    /**
     * 通过条件得到数量
     *
     * @return void
     */
    public function count()
    {

    }

    /**
     * 插入数据
     *
     * @return lastInsertID
     */
    public function insert()
    {

    }

    /**
     * 更新表单数据
     *
     * @return void
     */
    public function updateData()
    {

    }

    /**
     * 删除数据
     *
     * @return void
     */
    public function delete()
    {

    }

    /**
    * where条件组装
    *
    * @return void
    */
   private function where($where)
   {
        // if(!empty($where)) {
        //     foreach($where as $key=>$item){
        //         if(is_array($item)){
        //             app('db')->table($this->table)->where($key,$item[1], $item[0]);
        //             continue;
        //         }
        //         app('db')->table($this->table)->where($key, $item);
        //     }
        // }


   }


    

   

}	