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
	public function fetchOne($where = [], $field = [], $orderby='', $join = [] )
    { 

        if(!empty($where))
        {
            $this->where($where);
        }

        if(!empty($field))
        {
            $this->field($field);
        }

        if(!empty($join))
        {
            $this->join($join);
        }

        if(!empty($orderby))
        {
            $this->orderby($orderby);
        }

        $return = $this->one();

        return $return;
    }

    
    /**
     * 通过条件获取多条数据
     *
     * @return void
     */
    public function fetchAll($where = [], $field = [], $orderby='', $limit='',$offset='', $join = [] )
    { 
        //DB::connection()->enableQueryLog(); 

        if(!empty($where))
        {
            $this->where($where);
        }

        if(!empty($field))
        {
            $this->field($field);
        }

        if(!empty($join))
        {
            $this->join($join);
        }

        if(!empty($orderby))
        {
            $this->orderby($orderby);
        }

        if(!empty($limit))
        {
            $this->limit($limit);
        }

        if(!empty($offset))
        {
            $this->offset($offset);
        }
        
        $return = $this->get();
        
       // $return = $this->where($where)->join($join)->orderby($orderby)->limit($limit)->offset($offset)->field($field)->get();
       
       // $log = DB::getQueryLog();
      //  dd($log);   //打印sql语句
      return $return;
    }

    /**
     * 通过条件得到数量
     *
     * @return void
     */
    public function count($where = [], $field = [], $orderby='', $join = [] )
    { 

        if(!empty($where))
        {
            $this->where($where);
        }

        if(!empty($field))
        {
            $this->field($field);
        }

        if(!empty($join))
        {
            $this->join($join);
        }

        if(!empty($orderby))
        {
            $this->orderby($orderby);
        }

        $return = $this->model->count();

        return $return;
    }

    /**
     * 插入数据
     *
     * @return lastInsertID
     */
    public function insert($data = [], $insertId = false)
    {
        if($insertId){
            return $this->model->insertGetId($data);
        }else{
            return $this->model->insert($data);
        }
    }

    /**
     * 更新表单数据
     *
     * @return void
     */
    public function updateData($where = [], $data = [])
    {
        if(!empty($where)){
             $this->where($where);
        }

        return $this->model->update($data);
    }

    /**
     * 删除数据
     *
     * @return void
     */
    public function delete($where = [])
    {
        if(!empty($where)){
             $this->where($where);
        }

        return $this->model->delete();
    }

    /**
     * 清除整张表，也就是删除所有列并将自增ID置为0
     *
     * @return void
     */
    public function truncate()
    {
        return $this->model->truncate();
    }


    /**
     * 数据库基础操作
     *
     * @param [string] $sql 执行sql语句
     * @param [string] $type insert update select delete
     * @return void
     */
    public function sql($sql, $type)
    {
        return DB::$type($sql);
    }


    //基础方法改写
    public function where($where = [])
    {
        foreach($where as $key=>$item){
            if(!is_array($item)){
                $this->model->where($where[0],$where[1],$where[2]);
                break;
            }else{
                 $this->model->where($item[0],$item[1],$item[2]);
            }
            
        }
        return $this;
    }

    public function orderby($orderby = []){
        foreach($orderby as $key=>$item){
            $this->model->orderBy($key,$item);
        }
        return $this;
    }

    function limit($limit)
    {
        $this->model->limit($limit);
        return $this;
    }

    public function offset($offset){
         $this->model->offset($offset);
         return $this;
    }
    public function get(){
        return $this->model->get();
    }
   
   public function one()
   {
       return $this->model->first();
   }

   public function field($field='*')
   {
       return $this->model->select($field);
   }
   public function join($join){
        foreach($join as $item) {
             if(isset($item[3]) && $item[3] == 'left'){
                $this->model->leftJoin($item[0], $item[1],'=', $item[2]);
            }elseif(isset($item[3]) && $item[3] == 'cross'){
                $this->model->crossJoin($item[0], $item[1],'=', $item[2]);
            }else{
                $this->model->join($item[0], $item[1],'=', $item[2]);
            }
        }
        return $this;
   }
}	