<?php

<?php
namespace App\Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;
/**
 * ���ݿ������
 */
class BaseModel extends Model
{   
    protected $table;
    protected $model;

    public function __construct()
    {
        
    }
	/**
     * ͨ��������ѯһ������
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
                      return  $this->model->get();
 


 
    // ��ȡ��ִ�еĲ�ѯ����
   // DB::table($this->table)->where(['sid'=>1,'pid'=>0])->orderBy('sid','asc')->get();

    $log = DB::getQueryLog();
   // dd($log);   //��ӡsql���
 

 //exit;


        //return app('db')->table($this->table)->value($field)->get();
    }

    /**
     * ͨ��������ȡ��������
     *
     * @return void
     */
    public function  fetchAll()
    {

    }

    /**
     * ͨ�������õ�����
     *
     * @return void
     */
    public function count()
    {

    }

    /**
     * ��������
     *
     * @return lastInsertID
     */
    public function insert()
    {

    }

    /**
     * ���±�����
     *
     * @return void
     */
    public function updateData()
    {

    }

    /**
     * ɾ������
     *
     * @return void
     */
    public function delete()
    {

    }

    /**
    * where������װ
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

/**
     * �Զ������ݿ�SQL���
     *
     * @param mixed $type
     * select update delete statement
     * @return void
     */
    public function query($sql='', $type='')
    {
        return DB::$type($sql);
    }

    /**
     * �¼�����
     *
     * @return void
     */
    public function listen($sql, $bindings, $time)
    {
        return DB::listen(function($sql, $bindings, $time)
        {
            
        });
    }

   /**
    * ��ʼһ�����ݿ�����
    *
    * @return void
    */
   public function beginTransaction()
   {
       DB::beginTransaction();
   }

   /**
    * �ع�����
    *
    * @return void
    */
   public function  rollback()
   {
       DB::rollback();
   }

   /**
    * �ύ����
    *
    * @return void
    */
   public function  commit()
   {
       DB::commit();
   }

   /**
    * ��ȡ����
    *��Ҫʹ�ö�����ӣ�����ͨ�� DB::connection ����ȡ�ã�
    *
    * @return void
    */
   public function connection($db)
   {
        return $users = DB::connection($db);
   } 