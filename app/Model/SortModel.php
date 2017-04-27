<?php
namespace App\Model;

use App\Exceptions\Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class SortModel extends Model
{
    protected $table = 'sort';

    public function menu(){
		return $results = app('db')->table($this->table)->get();
	}
}	