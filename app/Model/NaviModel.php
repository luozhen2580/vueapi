<?php
namespace App\Model;

use App\Exceptions\Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class NaviModel extends Model
{
    protected $table = 'navi';

    public function findNavi(){
		return $results = app('db')->table('navi')->get();
	}
}