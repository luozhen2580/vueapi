<?php
namespace App\Model;
use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;
class UserModel extends BaseModel
{
   // protected $table = 'sort';
	public function __construct()
    {
        $this->table = 'user';
		$this->model = $db = DB::table($this->table);
    }
   

    public function checkLogin($username, $password){
         $data =  DB::table($this->table)
        ->where('username', '=', $username)
        ->first();
        if($data){
            if($data->app_pass == $password){
                return [
                    'uid' => $data->uid,
                    'username' => $data->username,
                    'nickname' => $data->nickname,
                    'role' => $data->role,
                    'email' => $data->email,
                    'description' => $data->description,
                ];
            }
        }

        return false;
    }

    public function userInfo($uid){
        $data =  DB::table($this->table)
        ->where('uid', '=', $uid)
        ->first();
        if($data){
            return [
                'uid' => $data->uid,
                'username' => $data->username,
                'nickname' => $data->nickname,
                'role' => $data->role,
                'email' => $data->email,
                'description' => $data->description,
            ];
           
        }

        return false;
    }
}	